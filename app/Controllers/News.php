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
            // SEO: Judul Halaman
            'title' => 'Berita & Artikel Terbaru - PT. Pesona Adi Batara',

            // SEO: Deskripsi singkat halaman ini untuk Google
            'meta_desc' => 'Dapatkan informasi terbaru seputar layanan logistik, transportasi, dan wawasan korporasi dari PT. Pesona Adi Batara.',

            // SEO: Gambar default jika link ini dishare di WA
            'meta_image' => base_url('assets/img/logo-pab.png'),

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

        // Logic membersihkan konten untuk Meta Description
        // Kita ambil 160 karakter pertama dari isi berita, dan buang tag HTML (seperti <p>, <b>)
        $cleanContent = strip_tags($news['content_id']);
        $metaDescription = substr($cleanContent, 0, 160) . '...';

        // Logic Gambar
        // Jika ada gambar berita pakai itu, jika tidak pakai logo default
        $imagePath = !empty($news['image'])
            ? base_url('uploads/news/' . $news['image'])
            : base_url('assets/img/logo-pab.png');

        $data = [
            // SEO: Judul sesuai judul berita
            'title'         => $news['title_id'],

            // SEO: Deskripsi otomatis diambil dari isi berita (agar Google suka)
            'meta_desc'     => $metaDescription,

            // SEO: Gambar spesifik berita ini (biar cantik saat share di WA/FB)
            'meta_image'    => $imagePath,

            // SEO: Keyword (Opsional, ambil dari kategori atau judul)
            'meta_keywords' => 'logistik, ' . $news['category'] . ', ' . $news['title_id'],

            // Data Utama
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

            // SEO khusus halaman kategori
            'meta_desc' => 'Kumpulan berita dan artikel untuk kategori ' . ucfirst($cat) . ' di PT. Pesona Adi Batara.',
            'meta_image' => base_url('assets/img/logo-pab.png'),

            'news_list' => $this->newsModel->where(['is_active' => 1, 'category' => $cat])
                ->orderBy('created_at', 'DESC')
                ->paginate(6, 'news'),
            'pager' => $this->newsModel->pager,
            'keyword' => null
        ];
        return view('news/index', $data);
    }
}
