<?php
namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'logs';
    protected $primaryKey = 'id';

    protected $allowedFields = ['id_user', 'aktivitas', 'waktu'];
}
