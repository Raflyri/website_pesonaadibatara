<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\ServicePageModel; // Load Model Page

class Services extends BaseController
{
    public function detail($category)
    {
        $serviceModel = new ServiceModel();
        $pageModel    = new ServicePageModel();

        // 1. Cek Kategori Valid (Manual array atau cek DB)
        $validCategories = ['transportasi', 'kesehatan', 'jasa', 'investasi'];
        if (!in_array($category, $validCategories)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 2. Ambil Data Header Page
        $pageData = $pageModel->find($category);

        // Fallback jika data page belum diisi admin
        if (!$pageData) {
            $pageData = [
                'page_title' => ucfirst($category),
                'page_description' => 'Solusi terbaik untuk kebutuhan bisnis Anda.',
                'hero_image' => null
            ];
        }

        // 3. Ambil List Items
        $items = $serviceModel->where(['category' => $category, 'is_active' => 1])->findAll();

        $data = [
            'title'    => $pageData['page_title'],
            'desc'     => $pageData['page_description'],
            'hero_img' => $pageData['hero_image'],
            'items'    => $items,
            'category' => $category
        ];

        return view('services/detail', $data);
    }
}