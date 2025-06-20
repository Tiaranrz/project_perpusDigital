<?php
namespace App\Models;
use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table      = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user', 'id_book', 'tanggal_pinjam', 'tanggal_kembali', 'status', 'petugas_id'
    ];

    public function getLaporan($filters = [])
    {
        $builder = $this->select('loans.*, users.username, books.judul')
            ->join('users', 'users.id = loans.id_user')
            ->join('books', 'books.id = loans.id_book');

        if (!empty($filters['status'])) {
            $builder->where('loans.status', $filters['status']);
        }
        if (!empty($filters['from']) && !empty($filters['to'])) {
            $builder->where('tanggal_pinjam >=', $filters['from']);
            $builder->where('tanggal_pinjam <=', $filters['to']);
        }

        return $builder->orderBy('loans.id', 'DESC')->findAll();
    }
}
