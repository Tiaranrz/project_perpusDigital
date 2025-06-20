<?php
namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\LaporanModel;

class Laporan extends BaseController
{
    public function index()
    {
        $model = new LaporanModel();
        $from = $this->request->getGet('from') ?? date('Y-m-d');
        $to   = $this->request->getGet('to') ?? date('Y-m-d');

        $filters = [
            'from' => $from,
            'to'   => $to,
        ];

        $reports = $model->getLaporan($filters);

        return view('petugas/laporan/index', [
            'reports' => $reports,
            'from'    => $from,
            'to'      => $to,
        ]);
    }

    public function cetak()
    {
        $model = new LaporanModel();
        $from = $this->request->getGet('from');
        $to   = $this->request->getGet('to');

        $filters = [
            'from' => $from,
            'to'   => $to,
        ];

        $reports = $model->getLaporan($filters);

        return view('petugas/laporan/print', [
            'reports' => $reports,
            'from'    => $from,
            'to'      => $to,
        ]);
    }
}
