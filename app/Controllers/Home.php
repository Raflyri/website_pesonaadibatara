<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\BannerModel;
use App\Models\SiteSettingModel;

class Home extends BaseController
{
    public function index()
    {
        // 1. Panggil Model
        $serviceModel = new ServiceModel();
        $bannerModel  = new BannerModel();
        $settingModel = new SiteSettingModel();
        
        // [BARU] Panggil Database Langsung untuk Page Section (Video & Teks)
        $db = \Config\Database::connect();
        $whyChooseUs = $db->table('page_sections')->where('section_key', 'home_why_choose_us')->get()->getRowArray();

        // 2. Siapkan Data untuk dikirim ke View
        $data = [
            'title'    => 'Home | PT. Pesona Adi Batara',
            'services' => $serviceModel->getActiveServices(),
            'banners'  => $bannerModel->getActiveBanners(),
            
            // [BARU] Masukkan data section ke sini agar bisa dibaca di View
            'why_choose_us' => $whyChooseUs, 
            
            // Settingan Footer
            'phone'    => $settingModel->getVal('company_phone'),
            'address'  => $settingModel->getVal('company_address'),
            'email'    => $settingModel->getVal('company_email'),
        ];

        // 3. Kirim ke View 'home'
        return view('home', $data);
    }
}