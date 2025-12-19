<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::index');
$routes->post('/auth/process', 'Auth::process');
$routes->get('/logout', 'Auth::logout');

// Placeholder untuk Dashboard (nanti kita buat)
$routes->get('/dashboard', function() {
    return "<h1>Selamat Datang di Admin Panel!</h1> <a href='/logout'>Logout</a>";
});

// GROUP ROUTES ADMIN
$routes->group('admin', function($routes) {
    // Dashboard (Placeholder)
    $routes->get('dashboard', function() { echo "Halo Admin! <a href='/admin/news'>Kelola Berita</a>"; });

    // Modul News
    $routes->get('news', 'Admin\News::index');          // List Berita
    $routes->get('news/create', 'Admin\News::create');  // Form Tambah
    $routes->post('news/store', 'Admin\News::store');   // Proses Simpan
});
