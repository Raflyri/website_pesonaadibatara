<?php

namespace App\Controllers;

class Services extends BaseController
{
    // Halaman Detail per Kategori (Misal: /layanan/transportasi)
    public function detail($category)
    {
        $validCategories = [
            'transportasi' => 'Bisnis Transportasi',
            'kesehatan'    => 'Bisnis Kesehatan',
            'jasa'         => 'Bisnis Jasa',
            'investasi'    => 'Bisnis Investasi'
        ];

        if (!array_key_exists($category, $validCategories)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Ambil data sub-layanan dari database (Nanti kamu isi tabel services)
        // Contoh Query: $items = $this->db->table('services')->where('category', $category)->get()->getResultArray();
        
        // Data Dummy Sementara sesuai PDF
        $dummyItems = [];
        if($category == 'transportasi') {
            $dummyItems = [
                ['title' => 'Luxury Car', 'desc' => 'Layanan sewa kendaraan mewah untuk VVIP.'],
                ['title' => 'Electric Vehicle', 'desc' => 'Armada ramah lingkungan berbasis listrik.'],
                ['title' => 'Operasional', 'desc' => 'Kendaraan operasional harian perusahaan.'],
            ];
        } 
        // ... dst bisa kamu lengkapi nanti

        $data = [
            'title' => $validCategories[$category],
            'category' => $category,
            'items' => $dummyItems 
        ];

        return view('services/detail', $data);
    }
}