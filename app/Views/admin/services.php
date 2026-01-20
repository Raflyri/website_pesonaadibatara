<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Services extends BaseController
{
    public function index()
    {
        // Kalau user buka /panel-pab/services langsung, lempar ke dashboard atau list umum
        return redirect()->to('/panel-pab/dashboard');
    }

    // Fungsi Dinamis untuk menangani 4 kategori sekaligus
    public function category($type)
    {
        // Validasi input URL biar ga sembarangan
        $validCategories = ['transportasi', 'kesehatan', 'jasa', 'investasi'];
        
        if (!in_array($type, $validCategories)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Judul Halaman dipercantik
        $titles = [
            'transportasi' => 'Bisnis Transportasi (Luxury & Operational)',
            'kesehatan'    => 'Bisnis Kesehatan (Batara Health Care)',
            'jasa'         => 'Bisnis Jasa (Fasade & Event Organizer)',
            'investasi'    => 'Bisnis Investasi & Food Beverages'
        ];

        $data = [
            'title' => $titles[$type],
            'category' => $type,
            // Nanti di sini kita tarik data dari database: 
            // $this->serviceModel->where('category', $type)->findAll();
        ];

        // Kita pakai satu view saja (reusable) biar hemat file
        return view('admin/services/index', $data);
    }
}