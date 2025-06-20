<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LoanModel;
use App\Models\ReturnModel;
use App\Models\BookModel;
use App\Models\UserModel;

class Peminjaman extends BaseController
{
    public function index()
{
    $loanModel = new \App\Models\LoanModel();

    // Ambil query string pencarian dan filter
    $search = $this->request->getGet('q');
    $status = $this->request->getGet('status');

    // Mulai query builder
    $builder = $loanModel
        ->select('loans.*, users.username, books.judul')
        ->join('users', 'users.id = loans.id_user')
        ->join('books', 'books.id = loans.id_book');

    if ($search) {
        $builder->groupStart()
            ->like('users.username', $search)
            ->orLike('books.judul', $search)
            ->groupEnd();
    }
    if ($status) {
        $builder->where('loans.status', $status);
    }

    // Pagination (10 data per halaman)
    $perPage = 10;
    $page = (int)($this->request->getGet('page') ?? 1);
    $data['loans'] = $builder->orderBy('loans.id', 'DESC')->paginate($perPage, 'default', $page);
    $data['pager'] = $loanModel->pager;

    // Untuk value di filter & search input
    $data['search'] = $search;
    $data['status'] = $status;

    return view('admin/peminjaman/index', $data);
}

    public function add()
    {
        $bookModel = new BookModel();
        $userModel = new UserModel();
        return view('admin/peminjaman/form', [
            'books' => $bookModel->findAll(),
            'users' => $userModel->where('role', 'siswa')->findAll()
        ]);
    }

    public function save()
    {
        $loanModel = new LoanModel();

        $id_book = $this->request->getPost('id_book');
        $id_user = $this->request->getPost('id_user');
        $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
        $tanggal_kembali = $this->request->getPost('tanggal_kembali');

        $loanModel->save([
            'id_user'         => $id_user,
            'id_book'         => $id_book,
            'tanggal_pinjam'  => $tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'status'          => 'pending',
            'petugas_id'      => session('user_id') // jika ada
        ]);

        return redirect()->to(base_url('admin/peminjaman'))->with('success', 'Peminjaman dalam antrian (pending). Silakan approve/reject.');
    }

    public function approve($id)
    {
        $loanModel = new LoanModel();
        $bookModel = new BookModel();

        $loan = $loanModel->find($id);
        $book = $bookModel->find($loan['id_book']);
        // Cek stok dulu
        if ($book['sisa'] < 1) {
            return redirect()->back()->with('errors', ['Stok buku habis!']);
        }
        // Setujui dan kurangi stok buku
        $loanModel->update($id, ['status' => 'approved']);
        $bookModel->update($loan['id_book'], ['sisa' => $book['sisa'] - 1]);
        return redirect()->to(base_url('admin/peminjaman'))->with('success', 'Peminjaman di-approve!');
    }

    public function reject($id)
    {
        $loanModel = new LoanModel();
        $loanModel->update($id, ['status' => 'rejected']);
        return redirect()->to(base_url('admin/peminjaman'))->with('success', 'Peminjaman di-reject.');
    }

    public function returnForm($id)
    {
        $loanModel = new LoanModel();
        $loan = $loanModel->find($id);
        return view('admin/peminjaman/return', [
            'loan' => $loan
        ]);
    }

    public function saveReturn($id)
    {
        $loanModel = new LoanModel();
        $returnModel = new ReturnModel();
        $bookModel = new BookModel();

        $loan = $loanModel->find($id);
        $tanggal_kembali = $this->request->getPost('tanggal_kembali');
        $denda = $this->request->getPost('denda');
        $keterangan = $this->request->getPost('keterangan');

        $loanModel->update($id, ['status' => 'dikembalikan']);
        $bookModel->update($loan['id_book'], [
            'sisa' => $bookModel->find($loan['id_book'])['sisa'] + 1
        ]);
        $returnModel->save([
            'id_loan' => $id,
            'tanggal_kembali' => $tanggal_kembali,
            'denda' => $denda,
            'keterangan' => $keterangan
        ]);
        return redirect()->to(base_url('admin/peminjaman'))->with('success', 'Pengembalian berhasil');
    }

    public function delete($id)
    {
        $loanModel = new LoanModel();
        $loanModel->delete($id);
        return redirect()->to(base_url('admin/peminjaman'))->with('success', 'Transaksi dihapus');
    }
}
