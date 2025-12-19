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

        // 2. Siapkan Data untuk dikirim ke View
        $data = [
            'title'    => 'Home | PT. Pesona Adi Batara',
            // Ambil data dari database
            'services' => $serviceModel->getActiveServices(),
            'banners'  => $bannerModel->getActiveBanners(),
            
            // Ambil settingan spesifik
            'phone'    => $settingModel->getVal('company_phone'),
            'address'  => $settingModel->getVal('company_address'),
            'email'    => $settingModel->getVal('company_email'),
        ];

        // 3. Kirim ke View 'home'
        return view('home', $data);
    }
}