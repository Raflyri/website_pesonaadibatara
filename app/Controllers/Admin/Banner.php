<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class Banner extends BaseController
{
    protected $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Banner Slider',
            'banners' => $this->bannerModel->orderBy('urutan', 'ASC')->findAll()
        ];
        return view('admin/banner/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Banner Baru'];
        return view('admin/banner/form', $data);
    }

    public function save($id = null)
    {
        // 1. Validasi Input
        if (!$this->validate([
            'title' => 'required',
            'image' => [
                'rules' => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]|max_size[image,2048]',
                'errors' => [
                    'max_size' => 'Ukuran gambar maksimal 2MB',
                    'mime_in' => 'Format gambar harus JPG, PNG, atau WEBP'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Siapkan Data
        $data = [
            'title' => $this->request->getPost('title'),
            'title_en' => $this->request->getPost('title_en'),
            'subtitle' => $this->request->getPost('subtitle'),
            'subtitle_en' => $this->request->getPost('subtitle_en'),
            'button_text' => $this->request->getPost('button_text'),
            'button_text_en' => $this->request->getPost('button_text_en'),
            'button_link' => $this->request->getPost('button_link'),
            'urutan' => $this->request->getPost('urutan'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        // 3. Handle Upload Gambar
        $fileImage = $this->request->getFile('image');
        
        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            // Kalau Edit & Ada Gambar Baru -> Hapus Gambar Lama
            if ($id) {
                $oldBanner = $this->bannerModel->find($id);
                if ($oldBanner['image'] && file_exists('uploads/banners/' . $oldBanner['image'])) {
                    unlink('uploads/banners/' . $oldBanner['image']);
                }
            }

            // Upload Gambar Baru
            $newName = $fileImage->getRandomName();
            $fileImage->move('uploads/banners', $newName);
            $data['image'] = $newName;
        }

        // 4. Simpan ke Database (Insert / Update)
        if ($id) {
            $this->bannerModel->update($id, $data);
        } else {
            // Kalau create baru tapi ga upload gambar (validasi lolos karena gambar optional di edit, tapi wajib di create logic)
            if(!isset($data['image'])) {
                 return redirect()->back()->withInput()->with('error', 'Gambar wajib diupload untuk banner baru!');
            }
            $this->bannerModel->insert($data);
        }

        return redirect()->to('/admin/banner')->with('success', 'Data Banner berhasil disimpan.');
    }

    public function edit($id)
    {
        $banner = $this->bannerModel->find($id);
        if (!$banner) return redirect()->to('/admin/banner');

        $data = [
            'title' => 'Edit Banner',
            'banner' => $banner
        ];
        return view('admin/banner/form', $data);
    }

    public function delete($id)
    {
        $banner = $this->bannerModel->find($id);
        if ($banner['image'] && file_exists('uploads/banners/' . $banner['image'])) {
            unlink('uploads/banners/' . $banner['image']);
        }
        $this->bannerModel->delete($id);
        return redirect()->to('/admin/banner')->with('success', 'Banner berhasil dihapus.');
    }
}