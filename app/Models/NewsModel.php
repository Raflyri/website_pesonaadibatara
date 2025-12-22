<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'title', 'slug', 'category', 'content', 
        'thumbnail', 'author', 'status', 'views', 
        'created_at', 'updated_at' // Pastikan kolom ini ada di tabel news kamu
    ];

    // Aktifkan auto timestamps agar tidak perlu isi tanggal manual
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}