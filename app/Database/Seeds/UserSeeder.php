<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT), // Password asli: admin123
            'fullname' => 'Administrator PAB',
            'role'     => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Masukkan ke tabel users
        $this->db->table('users')->insert($data);
    }
}