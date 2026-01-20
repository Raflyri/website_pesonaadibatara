<?php

namespace App\Controllers;

use App\Models\ServiceModel;
use App\Models\BannerModel;
use App\Models\SiteSettingModel;
use App\Models\NewsModel;

class Home extends BaseController
{
    public function index()
    {
        // 1. AKTIFKAN CACHING DI SINI
        // Halaman ini akan disimpan di cache selama 1 jam (3600 detik).
        // User berikutnya tidak akan membebani database selama cache masih valid.
        $this->cachePage(3600);
        
        $serviceModel = new ServiceModel();
        $bannerModel  = new BannerModel();
        $settingModel = new SiteSettingModel();
        $newsModel    = new NewsModel();
        $partnersModel = new \App\Models\PartnersModel();

        $db = \Config\Database::connect();
        $whyChooseUs = $db->table('page_sections')->where('section_key', 'home_why_choose_us')->get()->getRowArray();

        $data = [
            'title'    => 'Home | PT. Pesona Adi Batara',
            //'services' => $serviceModel->getActiveServices(),
            'services' => $serviceModel->where('is_active', 1)->findAll(),
            'banners'  => $bannerModel->getActiveBanners(),
            'why_choose_us' => $whyChooseUs,
            'latest_news' => $newsModel->where('category', 'berita')
                ->orderBy('created_at', 'DESC')
                ->findAll(3),
            'latest_articles' => $newsModel->where('category', 'artikel')
                ->orderBy('created_at', 'DESC')
                ->findAll(3),
            'phone'    => $settingModel->getVal('company_phone'),
            'address'  => $settingModel->getVal('company_address'),
            'email'    => $settingModel->getVal('company_email'),
            'partners' => $partnersModel->where('is_active', 1)
                ->orderBy('display_order', 'ASC')
                ->findAll(),
        ];

        return view('home', $data);
    }
}
