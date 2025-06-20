<?php
namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\LaporanModel;

class Laporan extends BaseController
{
    public function index()
    {
        $laporanModel = new LaporanModel();

        $status = $this->request->getGet('status');
        $from   = $this->request->getGet('from');
        $to     = $this->request->getGet('to');
        $filters = [
            'status' => $status,
            'from'   => $from,
            'to'     => $to
        ];
        $data['reports'] = $laporanModel->getLaporan($filters);
        $data['status'] = $status;
        $data['from'] = $from;
        $data['to'] = $to;
        return view('admin/laporan/index', $data);
    }

    // Export PDF/Print
    public function cetak()
    {
        $laporanModel = new LaporanModel();
        $status = $this->request->getGet('status');
        $from   = $this->request->getGet('from');
        $to     = $this->request->getGet('to');
        $filters = [
            'status' => $status,
            'from'   => $from,
            'to'     => $to
        ];
        $data['reports'] = $laporanModel->getLaporan($filters);
        $data['status'] = $status;
        $data['from'] = $from;
        $data['to'] = $to;
        return view('admin/laporan/cetak', $data); // Print view khusus tanpa layout
    }
}
