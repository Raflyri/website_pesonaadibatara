<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table            = 'banners';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['title', 'subtitle', 'image', 'button_text', 'button_link', 'urutan', 'is_active'];

    public function getActiveBanners()
    {
        // Ambil yang aktif, lalu urutkan sesuai keinginan klien
        return $this->where('is_active', 1)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }
}