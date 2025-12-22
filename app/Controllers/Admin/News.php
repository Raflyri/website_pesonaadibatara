<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\NewsModel; // Panggil Model yang baru dibuat

class News extends BaseController
{
    protected $newsModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
    }

    // 1. LIST BERITA & ARTIKEL
    public function index()
    {
        $data = [
            'title' => 'Kelola Berita & Artikel',
            // Ambil data urut terbaru & paginate
            'news'  => $this->newsModel->orderBy('created_at', 'DESC')->findAll(),
        ];
        return view('admin/news/index', $data);
    }

    // 2. FORM TAMBAH
    public function create()
    {
        $data = ['title' => 'Tulis Baru'];
        // Pastikan file view ini ada di app/Views/admin/news/create.php
        return view('admin/news/create', $data);
    }

    // 3. PROSES SIMPAN
    public function save()
    {
        // Validasi Input
        if (!$this->validate([
            'title'     => 'required',
            'category'  => 'required',
            // Validasi gambar: Maks 2MB, format gambar
            'thumbnail' => 'is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]|max_size[thumbnail,2048]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Pastikan data terisi benar & gambar max 2MB.');
        }

        // Proses Upload Gambar
        $fileThumb = $this->request->getFile('thumbnail');
        if ($fileThumb && $fileThumb->isValid() && !$fileThumb->hasMoved()) {
            $imageName = $fileThumb->getRandomName();
            $fileThumb->move('uploads/news', $imageName); // Simpan ke folder public/uploads/news
        } else {
            $imageName = null; // Atau set default.jpg jika mau
        }

        // Simpan ke Database via Model
        $this->newsModel->save([
            'title'     => $this->request->getPost('title'),
            'slug'      => url_title($this->request->getPost('title'), '-', true),
            'category'  => $this->request->getPost('category'),
            'content'   => $this->request->getPost('content'),
            'thumbnail' => $imageName,
            'author'    => $this->request->getPost('author'),
            'views'     => 0,
            'status'    => 'published' // Default langsung tayang
        ]);

        return redirect()->to('/admin/news')->with('success', 'Postingan berhasil diterbitkan!');
    }
    
    // (Opsional) Tambahkan method delete($id) dan edit($id) nanti
    public function delete($id)
    {
        $this->newsModel->delete($id);
        return redirect()->to('/admin/news')->with('success', 'Data dihapus.');
    }
}