<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // Simulasi Data Statistik (Nanti kita ganti dengan count() dari database real)
        $data = [
            'title' => 'Dashboard Overview',
            'stats' => [
                'news' => 12,      // Total Berita
                'services' => 8,   // Total Layanan
                'banners' => 3,    // Total Banner Aktif
                'users' => 5       // Total Admin
            ],
            'user_name' => session()->get('name') ?? 'Admin'
        ];

        return view('admin/dashboard', $data);
    }
}