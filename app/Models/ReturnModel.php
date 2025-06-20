<?php
namespace App\Models;

use CodeIgniter\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_loan', 'tanggal_kembali', 'denda', 'keterangan'];
}
