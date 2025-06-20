<?php
namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id_user', 'id_book', 'tanggal_pinjam', 'tanggal_kembali',
        'status', 'petugas_id', 'updated_at'
    ];

    protected $useTimestamps = false;
}
