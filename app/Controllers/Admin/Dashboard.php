<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookModel;
use App\Models\UserModel;
use App\Models\LoanModel;

class Dashboard extends BaseController
{
    public function index()
{
    $bookModel = new \App\Models\BookModel();
    $userModel = new \App\Models\UserModel();
    $loanModel = new \App\Models\LoanModel();

    // Total Buku
    $totalBuku = $bookModel->countAllResults();
    $bookModel->resetQuery();

    // Total Siswa
    $totalSiswa = $userModel->where('role', 'siswa')->countAllResults();
    $userModel->resetQuery();

    // Peminjaman Hari Ini
    $today = date('Y-m-d');
    $pinjamHariIni = $loanModel->where('tanggal_pinjam', $today)->countAllResults();
    $loanModel->resetQuery();

    // Buku Terlambat
    $bukuTerlambat = $loanModel
        ->where('status', 'approved')
        ->where('tanggal_kembali <', $today)
        ->countAllResults();
    $loanModel->resetQuery();

    // Grafik pinjam 7 hari terakhir
    $labels = [];
    $dataPinjam = [];
    for ($i = 6; $i >= 0; $i--) {
        $tanggal = date('Y-m-d', strtotime("-$i days"));
        $labels[] = date('d M', strtotime($tanggal));
        $dataPinjam[] = $loanModel->where('tanggal_pinjam', $tanggal)->countAllResults();
        $loanModel->resetQuery();
    }

    return view('admin/dashboard', [
        'totalBuku'      => $totalBuku,
        'totalSiswa'     => $totalSiswa,
        'pinjamHariIni'  => $pinjamHariIni,
        'bukuTerlambat'  => $bukuTerlambat,
        'labels'         => $labels,
        'dataPinjam'     => $dataPinjam,
    ]);
}

}
