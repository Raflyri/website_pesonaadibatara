<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\ServicePageModel;

/**
 * Kelola kategori (bidang) layanan bisnis.
 *
 * Sebelumnya kategori di-hardcode di navbar, footer, sidebar admin, dan
 * controller Services. Sekarang semuanya membaca tabel `service_pages`,
 * jadi penambahan bidang bisnis cukup dilakukan dari CMS.
 */
class ServiceCategories extends BaseController
{
    protected $pageModel;
    protected $serviceModel;

    public function __construct()
    {
        $this->pageModel    = new ServicePageModel();
        $this->serviceModel = new ServiceModel();
    }

    public function index()
    {
        $categories = $this->pageModel->getAllOrdered();

        // Hitung jumlah item per kategori supaya admin tahu dampak penghapusan.
        $counts = [];
        foreach ($categories as $row) {
            $counts[$row['category']] = $this->serviceModel
                ->where('category', $row['category'])
                ->countAllResults();
        }

        return view('panel-pab/service-categories/index', [
            'title'      => 'Kelola Kategori Layanan',
            'categories' => $categories,
            'counts'     => $counts,
        ]);
    }

    public function create()
    {
        return view('panel-pab/service-categories/form', [
            'title'    => 'Tambah Kategori Layanan',
            'category' => null,
            'colors'   => array_keys(ServicePageModel::COLOR_MAP),
        ]);
    }

    public function edit($category)
    {
        $row = $this->pageModel->find($category);
        if (!$row) {
            return redirect()->to('/panel-pab/service-categories')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        return view('panel-pab/service-categories/form', [
            'title'    => 'Edit Kategori: ' . ($row['nav_label'] ?: $row['category']),
            'category' => $row,
            'colors'   => array_keys(ServicePageModel::COLOR_MAP),
        ]);
    }

    public function store()
    {
        $slug = $this->slugFromInput();

        if ($slug === '') {
            return redirect()->back()->withInput()
                ->with('error', 'Slug tidak valid. Gunakan huruf/angka, misalnya "logistik".');
        }

        if ($this->pageModel->find($slug)) {
            return redirect()->back()->withInput()
                ->with('error', 'Slug "' . $slug . '" sudah dipakai kategori lain.');
        }

        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        $this->pageModel->insert($this->payload($slug) + [
            'page_title'       => $this->request->getPost('nav_label'),
            'page_description' => '',
        ]);

        return redirect()->to('/panel-pab/service-categories')
            ->with('success', 'Kategori "' . $slug . '" berhasil ditambahkan. Isi konten halamannya lewat menu Layanan Bisnis.');
    }

    public function update($category)
    {
        $row = $this->pageModel->find($category);
        if (!$row) {
            return redirect()->to('/panel-pab/service-categories')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        if (!$this->validate($this->rules())) {
            return redirect()->back()->withInput()
                ->with('error', implode(' ', $this->validator->getErrors()));
        }

        // Slug tidak diubah saat edit: dia dipakai sebagai URL publik
        // (/layanan/<slug>) dan sebagai relasi ke tabel `services`.
        $this->pageModel->update($category, $this->payload($category));

        return redirect()->to('/panel-pab/service-categories')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function delete($category)
    {
        $row = $this->pageModel->find($category);
        if (!$row) {
            return redirect()->to('/panel-pab/service-categories')
                ->with('error', 'Kategori tidak ditemukan.');
        }

        // Cegah kategori terhapus selagi masih memuat item layanan —
        // item-nya akan jadi yatim dan tidak bisa diakses dari mana pun.
        $itemCount = $this->serviceModel->where('category', $category)->countAllResults();
        if ($itemCount > 0) {
            return redirect()->to('/panel-pab/service-categories')
                ->with('error', 'Kategori "' . $category . '" masih memiliki ' . $itemCount . ' item layanan. Hapus atau pindahkan item tersebut lebih dulu.');
        }

        if (!empty($row['hero_image']) && is_file(FCPATH . 'uploads/services/' . $row['hero_image'])) {
            unlink(FCPATH . 'uploads/services/' . $row['hero_image']);
        }

        $this->pageModel->delete($category);

        return redirect()->to('/panel-pab/service-categories')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Slug diambil dari input khusus bila diisi, kalau tidak diturunkan
     * dari nama menu Indonesia.
     */
    private function slugFromInput(): string
    {
        $raw = trim((string) $this->request->getPost('category'));
        if ($raw === '') {
            $raw = (string) $this->request->getPost('nav_label');
        }

        return url_title($raw, '-', true);
    }

    private function rules(): array
    {
        return [
            'nav_label' => 'required|max_length[100]',
            'nav_desc'  => 'permit_empty|max_length[150]',
            'home_desc' => 'permit_empty|max_length[255]',
            'icon'      => 'permit_empty|max_length[60]',
        ];
    }

    private function payload(string $slug): array
    {
        $color = (string) $this->request->getPost('color');
        if (!array_key_exists($color, ServicePageModel::COLOR_MAP)) {
            $color = 'blue';
        }

        return [
            'category'     => $slug,
            'nav_label'    => trim((string) $this->request->getPost('nav_label')),
            'nav_label_en' => trim((string) $this->request->getPost('nav_label_en')),
            'nav_desc'     => trim((string) $this->request->getPost('nav_desc')),
            'nav_desc_en'  => trim((string) $this->request->getPost('nav_desc_en')),
            'home_desc'    => trim((string) $this->request->getPost('home_desc')),
            'home_desc_en' => trim((string) $this->request->getPost('home_desc_en')),
            'icon'         => trim((string) $this->request->getPost('icon')) ?: 'fas fa-concierge-bell',
            'color'        => $color,
            'sort_order'   => (int) $this->request->getPost('sort_order'),
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0,
        ];
    }
}
