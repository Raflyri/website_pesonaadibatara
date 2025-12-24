<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorModel extends Model
{
    protected $table = 'tb_visitors';
    protected $allowedFields = ['ip_address', 'user_agent', 'visit_date'];
    protected $useTimestamps = false; // Kita pakai native DB timestamp saja
}