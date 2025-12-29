<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicePageModel extends Model
{
    protected $table            = 'service_pages';
    protected $primaryKey       = 'category';
    protected $allowedFields    = ['category', 'page_title', 'page_description', 'hero_image'];
    protected $useTimestamps    = true;
    protected $updatedField     = 'updated_at'; 
}