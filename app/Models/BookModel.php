<?php
namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul', 'penulis', 'penerbit', 'tahun_terbit', 'isbn',
        'id_kategori', 'jumlah', 'sisa', 'cover', 'created_at'
    ];

    protected $useTimestamps = true;
    protected $useSoftDeletes = false;
protected $returnType = 'array';

}
