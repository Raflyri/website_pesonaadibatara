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

    // 1. HALAMAN UTAMA BLOG / LIST BERITA
    public function index()
    {
        $keyword = $this->request->getGet('keyword');
        
        // Base Query
        $newsQuery = $this->newsModel->where('is_active', 1);

        // Fitur Pencarian (Opsional, jika user ketik ?keyword=abc)
        if ($keyword) {
            $newsQuery->groupStart()
                ->like('title_id', $keyword)
                ->orLike('content_id', $keyword)
            ->groupEnd();
        }

        $data = [
            'title' => 'Berita & Artikel Terbaru',
            // Menampilkan 6 berita per halaman + Pagination otomatis
            'news_list' => $newsQuery->orderBy('created_at', 'DESC')->paginate(6, 'news'),
            'pager'     => $this->newsModel->pager,
            'keyword'   => $keyword
        ];

        return view('news/index', $data);
    }

    // 2. DETAIL BERITA (Sudah ada di routes sebelumnya)
    public function detail($slug)
    {
        $news = $this->newsModel->where('slug', $slug)->first();

        if (!$news) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Tambah counter views
        $this->newsModel->update($news['id'], ['views' => $news['views'] + 1]);

        $data = [
            'title' => $news['title_id'],
            'news'  => $news,
            'recent_news' => $this->newsModel->where('is_active', 1)
                                            ->orderBy('created_at', 'DESC')
                                            ->findAll(3)
        ];

        return view('news/detail', $data);
    }

    // 3. KATEGORI (Opsional)
    public function category($cat)
    {
        $data = [
            'title' => 'Kategori: ' . ucfirst($cat),
            'news_list' => $this->newsModel->where(['is_active' => 1, 'category' => $cat])
                                          ->orderBy('created_at', 'DESC')
                                          ->paginate(6, 'news'),
            'pager' => $this->newsModel->pager,
            'keyword' => null
        ];
        return view('news/index', $data);
    }
}