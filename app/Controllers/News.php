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

    public function index()
    {
        $keyword = $this->request->getGet('keyword');

        $newsQuery = $this->newsModel
            ->where('is_active', 1)
            ->where('date_published <=', date('Y-m-d'));

        if ($keyword) {
            $newsQuery->groupStart()
                ->like('title_id', $keyword)
                ->orLike('content_id', $keyword)
                ->groupEnd();
        }

        $data = [
            'title' => 'Berita & Artikel Terbaru - PT. Pesona Adi Batara',
            'meta_desc' => 'Dapatkan informasi terbaru seputar layanan logistik, transportasi, dan wawasan korporasi dari PT. Pesona Adi Batara.',
            'meta_image' => base_url('assets/img/logo-pab.png'),
            'news_list' => $newsQuery->orderBy('date_published', 'DESC')->paginate(6, 'news'),
            'pager'     => $this->newsModel->pager,
            'keyword'   => $keyword
        ];

        return view('news/index', $data);
    }

    public function detail($slug)
    {
        $news = $this->newsModel->where('slug', $slug)->first();

        if (!$news) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $this->newsModel->update($news['id'], ['views' => $news['views'] + 1]);

        $cleanContent = strip_tags($news['content_id']);
        $metaDescription = substr($cleanContent, 0, 160) . '...';

        $imagePath = !empty($news['image'])
            ? base_url('uploads/news/' . $news['image'])
            : base_url('assets/img/logo-pab.png');

        $data = [
            'title'         => $news['title_id'],
            'meta_desc'     => $metaDescription,
            'meta_image'    => $imagePath,
            'meta_keywords' => 'logistik, ' . $news['category'] . ', ' . $news['title_id'],

            'news'  => $news,
            'related_news' => $this->newsModel
                ->where('is_active', 1)
                ->where('category', 'news')
                ->where('id !=', $news['id'])
                ->where('date_published <=', date('Y-m-d'))
                ->orderBy('date_published', 'DESC')
                ->findAll(3),
            'related_articles' => $this->newsModel
                ->where('is_active', 1)
                ->where('category', 'artikel')
                ->where('id !=', $news['id'])
                ->where('date_published <=', date('Y-m-d'))
                ->orderBy('date_published', 'DESC')
                ->findAll(3),
        ];

        return view('news/detail', $data);
    }

    public function category($cat)
    {
        $data = [
            'title' => 'Kategori: ' . ucfirst($cat),
            'meta_desc' => 'Kumpulan berita dan artikel untuk kategori ' . ucfirst($cat) . ' di PT. Pesona Adi Batara.',
            'meta_image' => base_url('assets/img/logo-pab.png'),
            'news_list' => $this->newsModel->where(['is_active' => 1, 'category' => $cat])
                ->where('date_published <=', date('Y-m-d'))
                ->orderBy('date_published', 'DESC')
                ->paginate(6, 'news'),
            'pager' => $this->newsModel->pager,
            'keyword' => null
        ];
        return view('news/index', $data);
    }
}
