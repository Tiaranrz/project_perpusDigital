<?php
namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\LoanModel;
use App\Models\UserModel;
use App\Models\BookModel;

class Peminjaman extends BaseController
{
    public function index()
    {
        $model = new LoanModel();
        $userModel = new UserModel();
        $bookModel = new BookModel();

        $peminjaman = $model->select('loans.*, users.username, books.judul')
            ->join('users', 'users.id=loans.id_user')
            ->join('books', 'books.id=loans.id_book')
            ->orderBy('loans.id', 'DESC')
            ->findAll();

        return view('petugas/peminjaman/index', [
            'peminjaman' => $peminjaman
        ]);
    }

    public function approve($id)
    {
        $model = new LoanModel();
        $model->update($id, ['status' => 'approved']);
        return redirect()->to(base_url('petugas/peminjaman'))->with('success', 'Peminjaman berhasil di-approve!');
    }

    public function reject($id)
    {
        $model = new LoanModel();
        $model->update($id, ['status' => 'rejected']);
        return redirect()->to(base_url('petugas/peminjaman'))->with('success', 'Peminjaman berhasil di-reject!');
    }

    public function add() {
        $userModel = new UserModel();
        $bookModel = new BookModel();
        $siswa = $userModel->where('role', 'siswa')->orderBy('username', 'ASC')->findAll();
        $buku = $bookModel->orderBy('judul', 'ASC')->findAll();
        return view('petugas/peminjaman/form', [
            'form_action' => base_url('petugas/peminjaman/save'),
            'peminjaman'  => null,
            'siswa' => $siswa,
            'buku' => $buku
        ]);
    }
    public function save() {
        $rules = [
            'id_user' => 'required|is_natural_no_zero',
            'id_book' => 'required|is_natural_no_zero',
            'tanggal_pinjam' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $loanModel = new LoanModel();
        $loanModel->insert([
            'id_user' => $this->request->getPost('id_user'),
            'id_book' => $this->request->getPost('id_book'),
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali'),
            'status' => 'pending'
        ]);
        return redirect()->to(base_url('petugas/peminjaman'))->with('success', 'Peminjaman berhasil ditambahkan!');
    }
    public function edit($id) {
        $model = new LoanModel();
        $userModel = new UserModel();
        $bookModel = new BookModel();
        $peminjaman = $model->find($id);
        $siswa = $userModel->where('role', 'siswa')->orderBy('username', 'ASC')->findAll();
        $buku = $bookModel->orderBy('judul', 'ASC')->findAll();
        return view('petugas/peminjaman/form', [
            'form_action' => base_url('petugas/peminjaman/update/'.$id),
            'peminjaman'  => $peminjaman,
            'siswa' => $siswa,
            'buku' => $buku
        ]);
    }
    public function update($id) {
        $rules = [
            'id_user' => 'required|is_natural_no_zero',
            'id_book' => 'required|is_natural_no_zero',
            'tanggal_pinjam' => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        $loanModel = new LoanModel();
        $loanModel->update($id, [
            'id_user' => $this->request->getPost('id_user'),
            'id_book' => $this->request->getPost('id_book'),
            'tanggal_pinjam' => $this->request->getPost('tanggal_pinjam'),
            'tanggal_kembali' => $this->request->getPost('tanggal_kembali')
        ]);
        return redirect()->to(base_url('petugas/peminjaman'))->with('success', 'Peminjaman berhasil diupdate!');
    }
}
