<?php
namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\LoanModel;
use App\Models\CategoryModel;

class Landing extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $bookModel = new BookModel();
        $loanModel = new LoanModel();
        $categoryModel = new CategoryModel();

        $search   = $this->request->getGet('q');
        $kategori = $this->request->getGet('kategori');

        // Query buku dengan join kategori
        $books = $bookModel->select('books.*, categories.nama AS kategori_nama')
            ->join('categories', 'categories.id=books.id_kategori', 'left')
            ->orderBy('judul', 'ASC');

        if ($search) {
            $books->groupStart()
                  ->like('judul', $search)
                  ->orLike('penulis', $search)
                  ->groupEnd();
        }
        if ($kategori) {
            $books->where('id_kategori', $kategori);
        }
        $bookList = $books->findAll(24);

        // Kategori
        $categories = $categoryModel->orderBy('nama', 'ASC')->findAll();

        // Notifikasi jumlah (contoh: jatuh tempo)
        $notifikasiBaru = $loanModel
            ->where('id_user', $userId)
            ->where('status', 'jatuh tempo')
            ->countAllResults();

        return view('siswa/landing', [
            'books' => $bookList,
            'categories' => $categories,
            'kategori' => $kategori,
            'search' => $search,
            'notifikasiBaru' => $notifikasiBaru
        ]);
    }

    public function detail($id)
{
    $bookModel = new BookModel();
    $categoryModel = new CategoryModel();
    $book = $bookModel->select('books.*, categories.nama as kategori_nama')
        ->join('categories', 'categories.id=books.id_kategori', 'left')
        ->find($id);
    if (!$book) throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

    return view('siswa/detail_buku', ['book' => $book]);
}

public function formPinjam($id)
{
    $bookModel = new BookModel();
    $book = $bookModel->find($id);
    if (!$book || $book['sisa'] < 1) {
        return redirect()->to(base_url('siswa/landing'))->with('errors', ['Buku tidak tersedia untuk dipinjam']);
    }
    return view('siswa/form_pinjam', ['book' => $book]);
}

public function pinjam($id)
{
    $userId = session()->get('user_id');
    $bookModel = new BookModel();
    $loanModel = new LoanModel();
    $book = $bookModel->find($id);
    if (!$book || $book['sisa'] < 1) {
        return redirect()->to(base_url('siswa/landing'))->with('errors', ['Buku tidak tersedia untuk dipinjam']);
    }
    // Validasi siswa sudah pinjam buku yg sama dan belum dikembalikan
    $sudahPinjam = $loanModel
        ->where('id_user', $userId)
        ->where('id_book', $id)
        ->where('status', 'dipinjam')
        ->first();
    if ($sudahPinjam) {
        return redirect()->to(base_url('siswa/landing'))->with('errors', ['Kamu sudah meminjam buku ini dan belum dikembalikan!']);
    }
    // Simpan pinjaman
    $loanModel->insert([
        'id_user' => $userId,
        'id_book' => $id,
        'tanggal_pinjam' => date('Y-m-d'),
        'tanggal_kembali' => null,
        'status' => 'pending',
        'petugas_id' => null,
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    // Kurangi sisa stok
    $bookModel->update($id, ['sisa' => $book['sisa'] - 1]);
    return redirect()->to(base_url('siswa/riwayat'))->with('success', 'Permintaan pinjam buku berhasil dikirim. Tunggu persetujuan petugas.');
}

public function riwayat()
{
    $userId = session()->get('user_id');
    $loanModel = new LoanModel();
    $bookModel = new BookModel();

    $riwayat = $loanModel
        ->select('loans.*, books.judul, books.cover')
        ->join('books', 'books.id = loans.id_book')
        ->where('id_user', $userId)
        ->orderBy('loans.id', 'DESC')
        ->findAll();

    return view('siswa/riwayat', ['riwayat' => $riwayat]);
}

public function ajaxNotifikasi()
{
    $userId = session()->get('user_id');
    if (!$userId) {
        return $this->response->setJSON([
            'status' => 'fail',
            'notif' => [],
            'msg' => 'Belum login'
        ]);
    }
    $loanModel = new \App\Models\LoanModel();
    $today = date('Y-m-d');

    $notif = $loanModel->select('loans.*, books.judul, books.cover')
        ->join('books', 'books.id=loans.id_book')
        ->where('loans.id_user', $userId)
        ->whereIn('loans.status', ['dipinjam', 'jatuh tempo', 'ditolak', 'dikembalikan'])
        ->orderBy('loans.updated_at', 'DESC')
        ->findAll(15);

    return $this->response->setJSON([
        'status' => 'ok',
        'notif' => $notif,
        'today' => $today
    ]);
}




}
