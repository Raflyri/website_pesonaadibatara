<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// DETAIL LAYANAN (PUBLIC)
$routes->get('layanan/(:segment)', 'Services::detail/$1');

// DETAIL BERITA (PUBLIC) - [Baru Ditambahkan]
$routes->get('news/(:segment)', 'News::detail/$1');
$routes->get('news/category/(:segment)', 'News::category/$1'); 

// --- AUTHENTICATION ROUTES ---
$routes->get('login', 'Auth::login');
$routes->post('auth/process', 'Auth::process');
$routes->get('logout', 'Auth::logout');

// HALAMAN STATIS
$routes->get('about', 'About::index');
$routes->get('contact', 'Contact::index');
$routes->post('contact/send', 'Contact::send');

// --- ADMIN GROUP (DILINDUNGI SATPAM/FILTER) ---
// Semua yang ada di dalam sini WAJIB LOGIN
$routes->group('admin', ['filter' => 'authGuard'], function ($routes) {

    // DASHBOARD
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // 1. MODUL BERITA (NEWS) - SUDAH DIPERBAIKI KE 'SAVE'
    $routes->get('news', 'Admin\News::index');
    $routes->get('news/create', 'Admin\News::create');
    $routes->post('news/save', 'Admin\News::save');           // <-- PENTING: Pakai 'save', bukan 'store'
    $routes->get('news/edit/(:num)', 'Admin\News::edit/$1');
    $routes->post('news/update/(:num)', 'Admin\News::update/$1');
    $routes->delete('news/(:num)', 'Admin\News::delete/$1');
    $routes->get('news/delete/(:num)', 'Admin\News::delete/$1');

    // 2. MODUL LAYANAN (SERVICES)
    $routes->get('services/(:segment)', 'Admin\Services::category/$1');
    // (Nanti tambahkan create/save services di sini jika sudah dibuat)

    // 3. MODUL HOME EDITOR
    $routes->get('home-editor', 'Admin\HomeEditor::index');
    $routes->post('home-editor/update', 'Admin\HomeEditor::update');

    // 4. MODUL BANNER - (TYPO SUDAH DIPERBAIKI)
    $routes->get('banner', 'Admin\Banner::index');
    $routes->get('banner/create', 'Admin\Banner::create');    // <-- Sudah diperbaiki
    $routes->post('banner/save', 'Admin\Banner::save');
    $routes->post('banner/save/(:num)', 'Admin\Banner::save/$1');
    $routes->get('banner/edit/(:num)', 'Admin\Banner::edit/$1');
    $routes->get('banner/delete/(:num)', 'Admin\Banner::delete/$1'); // <-- Sudah diperbaiki

    // 5. MODUL ABOUT EDITOR
    $routes->get('about-editor', 'Admin\AboutEditor::index');
    $routes->post('about-editor/update', 'Admin\AboutEditor::update');

    // 6. MODUL TEAMS (DIREKSI)
    $routes->get('team', 'Admin\Team::index');
    $routes->get('team/create', 'Admin\Team::create');
    $routes->post('team/save', 'Admin\Team::save');
    $routes->post('team/save/(:num)', 'Admin\Team::save/$1');
    $routes->get('team/edit/(:num)', 'Admin\Team::edit/$1');
    $routes->get('team/delete/(:num)', 'Admin\Team::delete/$1');

    // 7. MODUL CONTACT & SOSMED
    $routes->get('contact-editor', 'Admin\ContactEditor::index');
    $routes->post('contact-editor/update', 'Admin\ContactEditor::updateContent');
    $routes->get('contact-editor/delete/(:num)', 'Admin\ContactEditor::deleteMessage/$1');

    // 8. ADMIN MANAGEMENT (CRUD USER)
    $routes->get('users', 'Admin\UserEditor::index');
    $routes->get('users/create', 'Admin\UserEditor::create');
    $routes->post('users/save', 'Admin\UserEditor::save');
    $routes->get('users/edit/(:num)', 'Admin\UserEditor::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\UserEditor::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\UserEditor::delete/$1');

    // 9. PROFILE SAYA
    $routes->get('profile', 'Admin\UserEditor::profile');
    $routes->post('profile/update', 'Admin\UserEditor::updateProfile');
    
    // 10. BACKUP DB
    $routes->get('backup-db', 'Admin\Backup::index');

    // 11. MODUL PARTNERS (KLIEN)
    $routes->get('partners', 'Admin\Partners::index');
    $routes->get('partners/create', 'Admin\Partners::create');
    $routes->post('partners/save', 'Admin\Partners::save');
    $routes->post('partners/save/(:num)', 'Admin\Partners::save/$1'); // Untuk update
    $routes->get('partners/edit/(:num)', 'Admin\Partners::edit/$1');
    $routes->get('partners/delete/(:num)', 'Admin\Partners::delete/$1');

    // --- TAMBAHKAN BARIS INI (API ROUTE) ---
    $routes->get('api/visitor-count', 'Admin\Dashboard::get_visitor_count');
});