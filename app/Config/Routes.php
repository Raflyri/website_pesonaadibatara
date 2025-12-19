<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('layanan/(:segment)', 'Services::detail/$1');

// --- AUTHENTICATION ROUTES ---
$routes->get('login', 'Auth::login');        // Ubah jadi login biar konsisten
$routes->post('auth/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');

// --- ADMIN GROUP (DILINDUNGI SATPAM/FILTER) ---
// Semua yang ada di dalam sini WAJIB LOGIN
$routes->group('admin', ['filter' => 'authGuard'], function($routes) {
    
    // [UPDATE] Arahkan Dashboard ke Controller, bukan closure lagi
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Modul News (Berita)
    $routes->get('news', 'Admin\News::index');          
    $routes->get('news/create', 'Admin\News::create');  
    $routes->post('news/store', 'Admin\News::store');  
    
    $routes->get('services/(:segment)', 'Admin\Services::category/$1');
});