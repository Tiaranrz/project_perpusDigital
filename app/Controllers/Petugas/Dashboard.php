<?php

namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\LoanModel;
use App\Models\ReturnModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $loanModel = new LoanModel();
        $returnModel = new ReturnModel();

        $today = date('Y-m-d');

        // Jumlah peminjaman hari ini
        $peminjamanHariIni = $loanModel
            ->where('tanggal_pinjam', $today)
            ->countAllResults();
        $loanModel->resetQuery();

        // Jumlah pengembalian hari ini
        $pengembalianHariIni = $returnModel
            ->where('tanggal_kembali', $today)
            ->countAllResults();
        $returnModel->resetQuery();

        // Grafik 7 hari terakhir: pinjam & kembali
        $labels = [];
        $dataPinjam = [];
        $dataKembali = [];
        for ($i = 6; $i >= 0; $i--) {
            $tanggal = date('Y-m-d', strtotime("-$i days"));
            $labels[] = date('d M', strtotime($tanggal));

            $dataPinjam[] = $loanModel->where('tanggal_pinjam', $tanggal)->countAllResults();
            $loanModel->resetQuery();

            $dataKembali[] = $returnModel->where('tanggal_kembali', $tanggal)->countAllResults();
            $returnModel->resetQuery();
        }

        return view('petugas/dashboard', [
            'peminjamanHariIni'   => $peminjamanHariIni,
            'pengembalianHariIni' => $pengembalianHariIni,
            'labels'              => $labels,
            'dataPinjam'          => $dataPinjam,
            'dataKembali'         => $dataKembali,
        ]);
    }
}
