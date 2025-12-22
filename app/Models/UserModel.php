<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    
    // SESUAIKAN DENGAN KOLOM DI DATABASE KAMU
    protected $allowedFields    = [
        'username', 
        'email',       // Baru ditambah
        'password', 
        'fullname',    // Di database namanya fullname, bukan name
        'role', 
        'avatar',      // Baru ditambah
        'is_active',   // Baru ditambah
        'last_login'
    ];

    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}