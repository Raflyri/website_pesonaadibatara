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
$routes->get('about', 'About::index');
// PUBLIK
$routes->get('contact', 'Contact::index');
$routes->post('contact/send', 'Contact::send');

// --- ADMIN GROUP (DILINDUNGI SATPAM/FILTER) ---
// Semua yang ada di dalam sini WAJIB LOGIN
$routes->group('admin', ['filter' => 'authGuard'], function ($routes) {

    // [UPDATE] Arahkan Dashboard ke Controller, bukan closure lagi
    $routes->get('dashboard', 'Admin\Dashboard::index');

    // Modul News (Berita)
    $routes->get('news', 'Admin\News::index');
    $routes->get('news/create', 'Admin\News::create');
    $routes->post('news/store', 'Admin\News::store');

    $routes->get('services/(:segment)', 'Admin\Services::category/$1');

    // Modul Home Editor
    $routes->get('home-editor', 'Admin\HomeEditor::index');       // Menampilkan Halaman
    $routes->post('home-editor/update', 'Admin\HomeEditor::update'); // Proses Simpan
    $routes->post('banner/save', 'Admin\Banner::save');
    $routes->post('banner/save/(:num)', 'Admin\Banner::save/$1'); // Untuk Update
    $routes->get('banner/edit/(:num)', 'Admin\Banner::edit/$1');
    $routes->get('banner/delete/(:num)', 'Admin\Bannerindex');

    // MODULE BANNER
    $routes->get('banner', 'Admin\Banner::index');
    $routes->get('banner/create', 'Admin\Banner::creat::delete/$1');

    $routes->get('about-editor', 'Admin\AboutEditor::index');
    $routes->post('about-editor/update', 'Admin\AboutEditor::update');

    // MODULE TEAMS (DIREKSI)
    $routes->get('team', 'Admin\Team::index');
    $routes->get('team/create', 'Admin\Team::create');
    $routes->post('team/save', 'Admin\Team::save');
    $routes->post('team/save/(:num)', 'Admin\Team::save/$1');
    $routes->get('team/edit/(:num)', 'Admin\Team::edit/$1');
    $routes->get('team/delete/(:num)', 'Admin\Team::delete/$1');

    // ADMIN (Tambahkan di dalam Group Admin)
    $routes->get('contact-editor', 'Admin\ContactEditor::index');
    $routes->post('contact-editor/update', 'Admin\ContactEditor::updateContent');
    $routes->get('contact-editor/delete/(:num)', 'Admin\ContactEditor::deleteMessage/$1');

    // --- ADMIN MANAGEMENT (CRUD) ---
    $routes->get('users', 'Admin\UserEditor::index');
    $routes->get('users/create', 'Admin\UserEditor::create');
    $routes->post('users/save', 'Admin\UserEditor::save');
    $routes->get('users/edit/(:num)', 'Admin\UserEditor::edit/$1');
    $routes->post('users/update/(:num)', 'Admin\UserEditor::update/$1');
    $routes->get('users/delete/(:num)', 'Admin\UserEditor::delete/$1');

    // --- PROFILE ---
    $routes->get('profile', 'Admin\UserEditor::profile');
    $routes->post('profile/update', 'Admin\UserEditor::updateProfile');
});
