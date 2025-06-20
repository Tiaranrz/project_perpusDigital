<?php
namespace App\Controllers\Petugas;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Anggota extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        // Ambil semua user dengan role siswa
        $anggota = $model->where('role', 'siswa')->orderBy('username','ASC')->findAll();

        return view('petugas/anggota/index', [
            'anggota' => $anggota
        ]);
    }
}
