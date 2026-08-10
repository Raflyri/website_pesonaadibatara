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
    
    public function index()
    {
        $data = [
            'title' => 'Kelola Berita & Artikel',
            'news'  => $this->newsModel->orderBy('date_published', 'DESC')->findAll(),
        ];
        return view('panel-pab/news/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tulis Baru'];
        return view('panel-pab/news/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'title'     => 'required',
            'category'  => 'required',
            'thumbnail' => 'is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]|ext_in[thumbnail,jpg,jpeg,png]|max_size[thumbnail,2048]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Pastikan data terisi benar & gambar max 2MB.');
        }

        $fileThumb = $this->request->getFile('thumbnail');
        $imageName = null;

        if ($fileThumb && $fileThumb->isValid() && !$fileThumb->hasMoved()) {
            $imageName = $fileThumb->getRandomName();
            $fileThumb->move('uploads/news', $imageName);
        }

        $title = $this->request->getPost('title');

        $this->newsModel->save([
            'slug'           => url_title($title, '-', true),
            'title_id'       => $title,
            'title_en'       => $title,

            'content_id'     => $this->request->getPost('content'),
            'content_en'     => $this->request->getPost('content'),

            'category'       => $this->request->getPost('category'),
            'image'          => $imageName, 
            'date_published' => $this->request->getPost('date_published'),
            'is_active'      => 1,
            'views'          => 0
        ]);

        log_activity('Tambah Berita', $title, 'success');

        return redirect()->to('/panel-pab/news')->with('success', 'Berita berhasil ditayangkan!');
    }

    public function delete($id)
    {
        // Cari data dulu (opsional, untuk cek apakah ada)
        $data = $this->newsModel->find($id);
        if (!$data) {
            return redirect()->to('/panel-pab/news')->with('error', 'Data tidak ditemukan.');
        }

        // Proses Hapus
        $this->newsModel->delete($id);

        // Hapus Gambar (Optional - agar server bersih)
        if ($data['image'] && file_exists('uploads/news/' . $data['image'])) {
            unlink('uploads/news/' . $data['image']);
        }

        log_activity('Hapus Berita', $data['title_id'] ?? '', 'danger');

        return redirect()->to('/panel-pab/news')->with('success', 'Berita berhasil dihapus.');
    }

    public function edit($id)
    {
        $news = $this->newsModel->find($id);
        
        if (!$news) {
            return redirect()->to('/panel-pab/news')->with('error', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Berita',
            'news'  => $news
        ];
        
        // Kita gunakan view yang berbeda biar rapi
        return view('panel-pab/news/edit', $data);
    }

    // 2. PROSES UPDATE PERUBAHAN
    public function update($id)
    {
        $newsLama = $this->newsModel->find($id);
        if (!$newsLama) {
            return redirect()->to('/panel-pab/news')->with('error', 'Data hilang.');
        }
        if (!$this->validate([
            'title'     => 'required',
            'category'  => 'required',
            'thumbnail' => 'is_image[thumbnail]|mime_in[thumbnail,image/jpg,image/jpeg,image/png]|ext_in[thumbnail,jpg,jpeg,png]|max_size[thumbnail,2048]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Periksa kembali inputan Anda.');
        }

        $fileThumb = $this->request->getFile('thumbnail');
        
        if ($fileThumb && $fileThumb->isValid() && !$fileThumb->hasMoved()) {
            if ($newsLama['image'] && file_exists('uploads/news/' . $newsLama['image'])) {
                unlink('uploads/news/' . $newsLama['image']);
            }
            $imageName = $fileThumb->getRandomName();
            $fileThumb->move('uploads/news', $imageName);
        } else {
            $imageName = $newsLama['image'];
        }

        $title = $this->request->getPost('title');
        
        $this->newsModel->update($id, [
            'slug'       => url_title($title, '-', true),
            'title_id'   => $title,
            'title_en'   => $title,
            'content_id' => $this->request->getPost('content'),
            'content_en' => $this->request->getPost('content'), // Sementara sama
            'category'   => $this->request->getPost('category'),
            'image'      => $imageName,
            'date_published' => $this->request->getPost('date_published'),
        ]);

        log_activity('Edit Berita', $title, 'info');

        return redirect()->to('/panel-pab/news')->with('success', 'Data berhasil diperbarui!');
    }
}
