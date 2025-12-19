<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class News extends BaseController
{
    // Kita pakai Query Builder biar cepat (Nanti bisa upgrade ke Model)
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Berita',
            'news_list' => $this->db->table('news')->orderBy('id', 'DESC')->get()->getResultArray()
        ];
        return view('admin/news/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tulis Berita Baru'
        ];
        return view('admin/news/form', $data);
    }

    public function store()
    {
        // 1. Ambil Data dari Form
        $data = [
            'title_id'       => $this->request->getPost('title_id'),
            'title_en'       => $this->request->getPost('title_en'), // Ini nanti hasil auto translate
            'slug'           => url_title($this->request->getPost('title_id'), '-', true),
            'content_id'     => $this->request->getPost('content_id'),
            'content_en'     => $this->request->getPost('content_en'),
            'category'       => $this->request->getPost('category'),
            'date_published' => date('Y-m-d'),
            'image'          => 'https://source.unsplash.com/random/800x600?business', // Placeholder dulu
            'is_active'      => 1
        ];

        // 2. Simpan ke Database
        $this->db->table('news')->insert($data);

        return redirect()->to('/admin/news')->with('success', 'Berita berhasil ditayangkan!');
    }
}