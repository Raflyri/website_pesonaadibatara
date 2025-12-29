<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\ServicePageModel;

class Services extends BaseController
{
    protected $serviceModel;
    protected $pageModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->pageModel    = new ServicePageModel();
    }

    // HALAMAN UTAMA EDITOR (Gabungan Header + List Item)
    public function index($category)
    {
        // 1. Ambil Data Header Halaman
        $pageData = $this->pageModel->find($category);
        
        // Jika belum ada di db, buat default array
        if(!$pageData) {
            $pageData = [
                'category' => $category,
                'page_title' => ucfirst($category),
                'page_description' => '',
                'hero_image' => ''
            ];
        }

        // 2. Ambil List Item Layanan (Cards)
        $services = $this->serviceModel->where('category', $category)->findAll();

        $data = [
            'title'    => 'Kelola Halaman: ' . ucfirst($category),
            'category' => $category,
            'page'     => $pageData,
            'services' => $services
        ];

        return view('admin/services/index', $data);
    }

    // --- PROSES 1: UPDATE HEADER HALAMAN ---
    public function updatePage($category)
    {
        // Validasi
        if (!$this->validate([
            'page_title' => 'required',
            'hero_image' => 'is_image[hero_image]|mime_in[hero_image,image/jpg,image/jpeg,image/png]|max_size[hero_image,2048]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Judul wajib diisi & cek format gambar.');
        }

        // Ambil data lama untuk cek gambar
        $oldData = $this->pageModel->find($category);
        $imageName = $oldData['hero_image'] ?? null;

        // Upload Gambar Header Baru
        $file = $this->request->getFile('hero_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Hapus gambar lama jika ada
            if ($imageName && file_exists('uploads/services/' . $imageName)) {
                unlink('uploads/services/' . $imageName);
            }
            $imageName = $file->getRandomName();
            $file->move('uploads/services', $imageName);
        }

        // Simpan / Update
        $this->pageModel->save([
            'category'         => $category,
            'page_title'       => $this->request->getPost('page_title'),
            'page_description' => $this->request->getPost('page_description'),
            'hero_image'       => $imageName
        ]);

        return redirect()->to('/admin/services/' . $category)->with('success', 'Header halaman berhasil diperbarui!');
    }

    // --- PROSES 2: CRUD ITEM LAYANAN (Sama seperti sebelumnya, sedikit penyesuaian) ---
    
    public function create($category)
    {
        $data = ['title' => 'Tambah Item Layanan', 'category' => $category];
        return view('admin/services/form', $data);
    }

    public function save()
    {
        $category = $this->request->getPost('category');
        
        // Proses Upload Image Item
        $file = $this->request->getFile('image');
        $imageName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('uploads/services', $imageName);
        }

        $this->serviceModel->save([
            'category'          => $category,
            'title'             => $this->request->getPost('title'),
            'slug'              => url_title($this->request->getPost('title'), '-', true),
            'short_description' => $this->request->getPost('short_description'),
            'content'           => $this->request->getPost('content'), // Opsional jika ada detail popup
            'image'             => $imageName,
            'is_active'         => 1
        ]);

        return redirect()->to('/admin/services/' . $category)->with('success', 'Item layanan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $service = $this->serviceModel->find($id);
        if (!$service) return redirect()->back();

        $data = [
            'title'    => 'Edit Item Layanan',
            'category' => $service['category'],
            'service'  => $service
        ];
        return view('admin/services/form', $data);
    }

    public function update($id)
    {
        $serviceLama = $this->serviceModel->find($id);
        $category = $this->request->getPost('category');
        
        // Logika upload gambar sama...
        $file = $this->request->getFile('image');
        $imageName = $serviceLama['image'];

        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($imageName && file_exists('uploads/services/' . $imageName)) unlink('uploads/services/' . $imageName);
            $imageName = $file->getRandomName();
            $file->move('uploads/services', $imageName);
        }

        $this->serviceModel->update($id, [
            'title'             => $this->request->getPost('title'),
            'slug'              => url_title($this->request->getPost('title'), '-', true),
            'short_description' => $this->request->getPost('short_description'),
            'content'           => $this->request->getPost('content'),
            'image'             => $imageName
        ]);

        return redirect()->to('/admin/services/' . $category)->with('success', 'Item berhasil diupdate.');
    }

    public function delete($id)
    {
        $data = $this->serviceModel->find($id);
        if($data) {
            $this->serviceModel->delete($id);
            return redirect()->to('/admin/services/' . $data['category'])->with('success', 'Item dihapus.');
        }
        return redirect()->back();
    }
}