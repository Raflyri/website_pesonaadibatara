<?php

namespace App\Models;

use CodeIgniter\Model;

class PartnersModel extends Model
{
    protected $table            = 'tb_partners';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['partner_name', 'partner_logo', 'partner_url', 'display_order', 'is_active'];
    protected $useTimestamps    = true; // Aktifkan created_at & updated_at
}