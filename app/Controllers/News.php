<?php

namespace App\Controllers;

use App\Models\NewsModel;

class News extends BaseController
{
    protected $newsModel;

    public function __construct()
    {
        $this->newsModel = new NewsModel();
    }

    // 1. HALAMAN DETAIL BERITA & ARTIKEL
    public function detail($slug)
    {
        // 1. Cari berita yang sedang dibuka
        $news = $this->newsModel->where('slug', $slug)
            ->where('is_active', 1)
            ->first();

        if (!$news) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // 2. Siapkan Data
        $data = [
            'title' => $news['title_id'],
            'news'  => $news,

            // [BARU] Ambil Berita Terkait (Kategori: Berita, Kecuali ID ini)
            'related_news' => $this->newsModel->where('category', 'berita')
                ->where('id !=', $news['id']) // Exclude current
                ->where('is_active', 1)
                ->orderBy('created_at', 'DESC')
                ->findAll(3),

            // [BARU] Ambil Artikel Terkait (Kategori: Artikel, Kecuali ID ini)
            'related_articles' => $this->newsModel->where('category', 'artikel')
                ->where('id !=', $news['id']) // Exclude current
                ->where('is_active', 1)
                ->orderBy('created_at', 'DESC')
                ->findAll(3),
        ];

        return view('news/detail', $data);
    }

    // 2. HALAMAN KATEGORI (Opsional: Jika tombol "Lihat Semua" diklik)
    public function category($type)
    {
        $data = [
            'title' => 'Kategori: ' . ucfirst($type),
            'news_list' => $this->newsModel->where('category', $type)
                ->where('is_active', 1)
                ->orderBy('created_at', 'DESC')
                ->paginate(6), // 6 item per halaman
            'pager' => $this->newsModel->pager,
            'category' => $type
        ];

        return view('news/category', $data);
    }
}
