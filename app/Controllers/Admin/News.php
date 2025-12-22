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
        // 1. Validasi Input
        if (!$this->validate([
            'title'     => 'required',
            'category'  => 'required',
            'thumbnail' => 'is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]|max_size[thumbnail,2048]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Pastikan data terisi benar & gambar max 2MB.');
        }

        // 2. Proses Upload Gambar
        $fileThumb = $this->request->getFile('thumbnail');
        $imageName = null;

        if ($fileThumb && $fileThumb->isValid() && !$fileThumb->hasMoved()) {
            $imageName = $fileThumb->getRandomName();
            $fileThumb->move('uploads/news', $imageName);
        }

        // 3. Simpan ke Database (MAPPING KE KOLOM _ID)
        // Kita ambil input 'title' dari form, lalu masukkan ke 'title_id'

        $title = $this->request->getPost('title');

        $this->newsModel->save([
            'slug'           => url_title($title, '-', true),
            'title_id'       => $title,
            'title_en'       => $title, // Sementara isi sama dengan ID (biar gak kosong)

            'content_id'     => $this->request->getPost('content'),
            'content_en'     => $this->request->getPost('content'), // Sementara isi sama

            'category'       => $this->request->getPost('category'),
            'image'          => $imageName, // Ingat: Di DB namanya 'image', bukan 'thumbnail'
            'date_published' => date('Y-m-d'),
            'is_active'      => 1, // Default aktif
            'views'          => 0
        ]);

        return redirect()->to('/admin/news')->with('success', 'Berita berhasil ditayangkan!');
    }

    // (Opsional) Tambahkan method delete($id) dan edit($id) nanti
    public function delete($id)
    {
        // Cari data dulu (opsional, untuk cek apakah ada)
        $data = $this->newsModel->find($id);
        if (!$data) {
            return redirect()->to('/admin/news')->with('error', 'Data tidak ditemukan.');
        }

        // Proses Hapus
        $this->newsModel->delete($id);

        // Hapus Gambar (Optional - agar server bersih)
        if ($data['image'] && file_exists('uploads/news/' . $data['image'])) {
            unlink('uploads/news/' . $data['image']);
        }

        return redirect()->to('/admin/news')->with('success', 'Berita berhasil dihapus.');
    }

    // --- TAMBAHKAN DUA FUNGSI INI ---

    // 1. TAMPILKAN FORM EDIT
    public function edit($id)
    {
        $news = $this->newsModel->find($id);
        
        if (!$news) {
            return redirect()->to('/admin/news')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Berita',
            'news'  => $news
        ];
        
        // Kita gunakan view yang berbeda biar rapi
        return view('admin/news/edit', $data);
    }

    // 2. PROSES UPDATE PERUBAHAN
    public function update($id)
    {
        // Cek data lama
        $newsLama = $this->newsModel->find($id);
        if (!$newsLama) {
            return redirect()->to('/admin/news')->with('error', 'Data hilang.');
        }

        // Validasi (Thumbnail boleh kosong saat edit)
        if (!$this->validate([
            'title'     => 'required',
            'category'  => 'required',
            'thumbnail' => 'is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]|max_size[thumbnail,2048]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Periksa kembali inputan Anda.');
        }

        // Cek apakah user upload gambar baru?
        $fileThumb = $this->request->getFile('thumbnail');
        
        // Jika upload gambar baru -> Pakai gambar baru & Hapus gambar lama
        if ($fileThumb && $fileThumb->isValid() && !$fileThumb->hasMoved()) {
            // Hapus file lama jika ada
            if ($newsLama['image'] && file_exists('uploads/news/' . $newsLama['image'])) {
                unlink('uploads/news/' . $newsLama['image']);
            }
            // Upload yang baru
            $imageName = $fileThumb->getRandomName();
            $fileThumb->move('uploads/news', $imageName);
        } else {
            // Jika tidak upload -> Pakai nama file lama
            $imageName = $newsLama['image'];
        }

        // Simpan Perubahan (Mapping ke kolom _id)
        $title = $this->request->getPost('title');
        
        $this->newsModel->update($id, [
            'slug'       => url_title($title, '-', true),
            'title_id'   => $title,
            'title_en'   => $title, // Sementara sama
            'content_id' => $this->request->getPost('content'),
            'content_en' => $this->request->getPost('content'), // Sementara sama
            'category'   => $this->request->getPost('category'),
            'image'      => $imageName
        ]);

        return redirect()->to('/admin/news')->with('success', 'Data berhasil diperbarui!');
    }
}
