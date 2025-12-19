<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table            = 'services';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array'; // Bisa 'object' kalau suka ->title
    protected $allowedFields    = ['slug', 'title', 'icon', 'short_description', 'content', 'image', 'is_active'];

    // Fitur: Ambil hanya layanan yang aktif untuk ditampilkan di depan
    public function getActiveServices()
    {
        return $this->where('is_active', 1)->findAll();
    }
}