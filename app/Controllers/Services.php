<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\ServicePageModel;

class Services extends BaseController
{
    public function detail($category)
    {
        $serviceModel = new ServiceModel();
        $pageModel    = new ServicePageModel();
        $settingModel = new \App\Models\SiteSettingModel();

        // 1. Kategori valid = yang terdaftar & aktif di CMS (bukan lagi hardcode),
        //    supaya kategori baru langsung bisa diakses tanpa ubah kode.
        $pageData = $pageModel->find($category);

        if (!$pageData || (int) ($pageData['is_active'] ?? 1) !== 1) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 2. Fallback judul bila header halaman belum diisi admin
        if (empty($pageData['page_title'])) {
            $pageData['page_title'] = $pageData['nav_label'] ?: ucfirst($category);
        }
        if (empty($pageData['page_description'])) {
            $pageData['page_description'] = 'Solusi terbaik untuk kebutuhan bisnis Anda.';
        }

        // 3. Ambil List Items
        $items = $serviceModel->where(['category' => $category, 'is_active' => 1])->findAll();

        $data = [
            'title'    => $pageData['page_title'],
            'desc'     => $pageData['page_description'],
            'hero_img' => $pageData['hero_image'],
            'items'    => $items,
            'category' => $category,
            'whatsapp' => $settingModel->getVal('company_whatsapp')
        ];

        return view('services/detail', $data);
    }
}