<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = true; // Aktifkan timestamps otomatis
    
    // Tambahkan 'category' ke sini
    protected $allowedFields    = ['category', 'slug', 'title', 'icon', 'short_description', 'content', 'image', 'is_active'];

    // Fitur: Ambil layanan aktif berdasarkan kategori
    public function getServicesByCategory($category)
    {
        return $this->where(['is_active' => 1, 'category' => $category])->findAll();
    }
}