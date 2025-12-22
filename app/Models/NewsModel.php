<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    
    // UPDATE SESUAI DATABASE KAMU
    protected $allowedFields    = [
        'slug', 
        'title_id', 'title_en',       // Judul 2 Bahasa
        'content_id', 'content_en',   // Konten 2 Bahasa
        'image',                      // Nama file gambar
        'category', 
        'date_published', 
        'is_active',
        'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}