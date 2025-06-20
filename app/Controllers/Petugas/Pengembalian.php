<?php
namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\LoanModel;
use App\Models\ReturnModel;
use App\Models\UserModel;
use App\Models\BookModel;

class Pengembalian extends BaseController
{
    public function index()
    {
        // Tampilkan daftar pengembalian buku (history returns)
        $returnModel = new ReturnModel();
        $data['pengembalian'] = $returnModel
            ->select('returns.*, loans.tanggal_pinjam, loans.tanggal_kembali as jatuh_tempo, users.username, books.judul')
            ->join('loans', 'loans.id=returns.id_loan')
            ->join('users', 'users.id=loans.id_user')
            ->join('books', 'books.id=loans.id_book')
            ->orderBy('returns.tanggal_kembali', 'DESC')
            ->findAll();
        return view('petugas/pengembalian/index', $data);
    }

    public function add()
    {
        // Pinjaman yang statusnya masih 'approved' dan BELUM ADA di tabel returns (belum dikembalikan)
        $loanModel = new LoanModel();
        $loans = $loanModel
            ->select('loans.*, users.username, books.judul')
            ->join('users', 'users.id=loans.id_user')
            ->join('books', 'books.id=loans.id_book')
            ->where('loans.status', 'approved')
            ->where('NOT EXISTS (SELECT 1 FROM returns WHERE returns.id_loan = loans.id)', null, false)
            ->orderBy('loans.tanggal_pinjam', 'DESC')
            ->findAll();

        return view('petugas/pengembalian/form', [
            'loans' => $loans,
            'form_action' => base_url('petugas/pengembalian/save')
        ]);
    }

    public function save()
    {
        $id_loan         = $this->request->getPost('loan_id');
        $tanggal_kembali = $this->request->getPost('tanggal_kembali');
        $keterangan      = $this->request->getPost('keterangan');
        $dendaPerHari    = 1000;

        $loanModel   = new LoanModel();
        $returnModel = new ReturnModel();
        $loan = $loanModel->find($id_loan);

        if (!$loan) {
            return redirect()->back()->withInput()->with('errors', ['Data peminjaman tidak ditemukan']);
        }

        // Hitung denda
        $jatuhTempo = $loan['tanggal_kembali'];
        $hariTerlambat = 0;
        $denda = 0;
        if ($jatuhTempo && $tanggal_kembali > $jatuhTempo) {
            $hariTerlambat = (strtotime($tanggal_kembali) - strtotime($jatuhTempo)) / 86400;
            $hariTerlambat = (int) $hariTerlambat;
            $denda = $hariTerlambat * $dendaPerHari;
        }

        // Simpan ke tabel returns
        $returnModel->insert([
            'id_loan'         => $id_loan,
            'tanggal_kembali' => $tanggal_kembali,
            'denda'           => $denda,
            'keterangan'      => $keterangan
        ]);

        // Update status loan menjadi "returned"
        $loanModel->update($id_loan, ['status' => 'returned']);

        return redirect()->to(base_url('petugas/pengembalian'))
            ->with('success', 'Pengembalian berhasil! ' . ($denda > 0 ? "Terlambat {$hariTerlambat} hari, Denda: Rp" . number_format($denda,0,',','.') : ''));
    }
}
