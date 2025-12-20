<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $table            = 'banners';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'title', 'title_en', 
        'subtitle', 'subtitle_en', 
        'image', 
        'button_text', 'button_text_en', 'button_link', 
        'urutan', 'is_active'
    ];

    // Fungsi khusus untuk mengambil banner yang AKTIF saja di Halaman Depan
    public function getActiveBanners()
    {
        return $this->where('is_active', 1)
                    ->orderBy('urutan', 'ASC')
                    ->findAll();
    }
}