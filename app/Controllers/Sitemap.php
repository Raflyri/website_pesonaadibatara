<?php

namespace App\Controllers;

use App\Models\NewsModel;

class Sitemap extends BaseController
{
    public function index()
    {
        $newsModel = new NewsModel();
        
        // 1. Ambil semua berita yang aktif
        $news = $newsModel->where('is_active', 1)
                          ->orderBy('created_at', 'DESC')
                          ->findAll();

        // 2. Definisi Halaman Statis (Manual)
        // Masukkan URL halaman utama yang tidak berubah-ubah
        $staticPages = [
            '/',
            '/about',
            '/services',
            '/career',
            '/contact',
            '/layanan/transportasi', // Jika ini halaman statis
            '/layanan/kesehatan',
            '/layanan/jasa',
            '/layanan/investasi'
        ];

        // 3. Mulai menyusun XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // A. Loop Halaman Statis
        foreach ($staticPages as $page) {
            $xml .= '<url>';
            $xml .= '<loc>' . base_url($page) . '</loc>';
            $xml .= '<changefreq>monthly</changefreq>'; // Seberapa sering berubah
            $xml .= '<priority>0.8</priority>';
            $xml .= '</url>';
        }

        // B. Loop Halaman Berita (Dinamis)
        foreach ($news as $item) {
            $xml .= '<url>';
            // Pastikan route 'news/slug' sesuai dengan Routes.php
            $xml .= '<loc>' . base_url('news/' . $item['slug']) . '</loc>';
            
            // Gunakan tanggal update berita jika ada, atau tanggal buat
            $date = $item['updated_at'] ? date('c', strtotime($item['updated_at'])) : date('c', strtotime($item['created_at']));
            
            $xml .= '<lastmod>' . $date . '</lastmod>';
            $xml .= '<changefreq>weekly</changefreq>';
            $xml .= '<priority>0.9</priority>'; // Berita biasanya prioritas tinggi
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        // 4. Return sebagai XML, bukan HTML biasa
        return $this->response->setContentType('text/xml')->setBody($xml);
    }
}