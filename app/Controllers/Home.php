<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\BannerModel;
use App\Models\SiteSettingModel;
use App\Models\NewsModel; // <--- 1. TAMBAHKAN INI

class Home extends BaseController
{
    public function index()
    {
        $serviceModel = new ServiceModel();
        $bannerModel  = new BannerModel();
        $settingModel = new SiteSettingModel();
        $newsModel    = new NewsModel(); // <--- 2. INSTANSIASI MODEL
        
        $db = \Config\Database::connect();
        $whyChooseUs = $db->table('page_sections')->where('section_key', 'home_why_choose_us')->get()->getRowArray();

        $data = [
            'title'    => 'Home | PT. Pesona Adi Batara',
            'services' => $serviceModel->getActiveServices(),
            'banners'  => $bannerModel->getActiveBanners(),
            'why_choose_us' => $whyChooseUs,
            
            // --- 3. AMBIL DATA TERPISAH ---
            // Ambil 3 Berita Terbaru
            'latest_news' => $newsModel->where('category', 'berita')
                                       ->orderBy('created_at', 'DESC')
                                       ->findAll(3),
                                       
            // Ambil 3 Artikel Terbaru
            'latest_articles' => $newsModel->where('category', 'artikel')
                                           ->orderBy('created_at', 'DESC')
                                           ->findAll(3),
            // -----------------------------
            
            'phone'    => $settingModel->getVal('company_phone'),
            'address'  => $settingModel->getVal('company_address'),
            'email'    => $settingModel->getVal('company_email'),
        ];

        return view('home', $data);
    }
}