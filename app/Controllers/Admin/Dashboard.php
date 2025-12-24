<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use App\Models\ServiceModel; 
use App\Models\BannerModel;
use App\Models\UserModel;
//use App\Models\PartnersModel;
use App\Models\VisitorModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // 1. Inisialisasi Database & Model
        $db           = \Config\Database::connect();
        $visitorModel = new VisitorModel();
        $newsModel    = new NewsModel();
        $serviceModel = new ServiceModel();
        $bannerModel  = new BannerModel();
        $userModel    = new UserModel();

        // 2. LOGIC HITUNG STATISTIK CMS
        try {
            $totalNews     = $newsModel->countAllResults();
            $totalServices = $serviceModel->countAllResults();
            $totalBanners  = $bannerModel->countAllResults();
            $totalUsers    = $userModel->countAllResults();
            
            // Cek Partners
            if (class_exists('App\Models\PartnersModel')) {
                $partnerModel = new \App\Models\PartnersModel();
                $totalPartners = $partnerModel->countAllResults();
            } else {
                $totalPartners = 0;
            }

        } catch (\Exception $e) {
            $totalNews = 0; $totalServices = 0; $totalBanners = 0; $totalUsers = 0; $totalPartners = 0;
        }

        // 3. LOGIC HITUNG SERVER STATUS (REALTIME)
        
        // A. Database Size
        $dbName = $db->database;
        $query  = $db->query("SELECT sum(data_length + index_length) / 1024 / 1024 AS 'size_mb' 
                              FROM information_schema.TABLES 
                              WHERE table_schema = '$dbName'");
        $dbSize = $query->getRow()->size_mb ?? 0;
        $dbQuota = 500; // Asumsi Quota 500MB
        $dbPercentage = ($dbQuota > 0) ? ($dbSize / $dbQuota) * 100 : 0;

        // B. CPU Load
        $cpuLoad = 0;
        if (function_exists('sys_getloadavg')) {
            $load = sys_getloadavg();
            $cpuLoad = $load[0] * 100; 
        } else {
            $cpuLoad = rand(10, 35); // Dummy Localhost
        }
        if ($cpuLoad > 100) $cpuLoad = 100;

        $today = date('Y-m-d');
        $visitorsToday = $visitorModel->where('visit_date', $today)->countAllResults();


        // 4. KIRIM DATA KE VIEW (PAKET LENGKAP)
        $data = [
            'title' => 'Dashboard Overview',
            
            // Statistik Kotak Atas
            'stats' => [
                'news'      => $totalNews,
                'services'  => $totalServices,
                'banners'   => $totalBanners,
                'users'     => $totalUsers,
                'partners'  => $totalPartners,
                'visitors'  => $visitorsToday
            ],

            // Widget Server Status (Progress Bar)
            'server' => [
                'db_size' => number_format($dbSize, 2),
                'db_pct'  => round($dbPercentage),
                'cpu_pct' => round($cpuLoad),
            ],

            // Info System (Tabel Bawah) - INI YANG TADI KETINGGALAN
            'system_info' => [
                'ci_version'  => \CodeIgniter\CodeIgniter::CI_VERSION,
                'php_version' => phpversion(),
                'db_version'  => $db->getVersion(),
                'server_ip'   => $_SERVER['SERVER_ADDR'] ?? '127.0.0.1',
                'environment' => getenv('CI_ENVIRONMENT') ?: 'production',
            ],

            'user_name' => session()->get('name') ?? 'Admin'
        ];

        return view('admin/dashboard', $data);
    }

    public function get_visitor_count()
    {
        // Pastikan hanya admin yang bisa akses
        if (!session()->get('isLoggedIn')) return $this->response->setJSON(['status' => 'error']);

        $visitorModel = new VisitorModel();
        $today = date('Y-m-d');
        $count = $visitorModel->where('visit_date', $today)->countAllResults();

        return $this->response->setJSON(['count' => $count]);
    }
}