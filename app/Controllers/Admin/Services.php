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

    public function index($category)
    {
        $pageData = $this->pageModel->find($category);

        if (!$pageData) {
            $pageData = [
                'category' => $category,
                'page_title' => ucfirst($category),
                'page_description' => '',
                'hero_image' => ''
            ];
        }
        $services = $this->serviceModel->where('category', $category)->findAll();

        $data = [
            'title'    => 'Kelola Halaman: ' . ucfirst($category),
            'category' => $category,
            'page'     => $pageData,
            'services' => $services
        ];

        return view('panel-pab/services/index', $data);
    }
    public function updatePage($category)
    {
        if (!$this->validate([
            'page_title' => 'required',
            'hero_image' => 'is_image[hero_image]|mime_in[hero_image,image/jpg,image/jpeg,image/png]|max_size[hero_image,2048]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Judul wajib diisi & cek format gambar.');
        }

        $oldData = $this->pageModel->find($category);
        $imageName = $oldData['hero_image'] ?? null;

        $file = $this->request->getFile('hero_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {

            if ($imageName && file_exists('uploads/services/' . $imageName)) {
                unlink('uploads/services/' . $imageName);
            }
            $imageName = $file->getRandomName();
            $file->move('uploads/services', $imageName);
        }
        $this->pageModel->save([
            'category'         => $category,
            'page_title'       => $this->request->getPost('page_title'),
            'page_description' => $this->request->getPost('page_description'),
            'hero_image'       => $imageName
        ]);

        return redirect()->to('/panel-pab/services/' . $category)->with('success', 'Header halaman berhasil diperbarui!');
    }


    public function create($category)
    {
        $data = ['title' => 'Tambah Item Layanan', 'category' => $category];
        return view('panel-pab/services/form', $data);
    }

    public function save()
    {
        $category = $this->request->getPost('category');

        $galleryFiles = $this->request->getFileMultiple('gallery');
        $validCount = 0;

        if ($galleryFiles) {
            foreach ($galleryFiles as $file) {
                if ($file->isValid()) $validCount++;
            }
        }

        if ($validCount > 5) {
            return redirect()->back()->withInput()->with('error', 'Gagal! Maksimal upload hanya 5 gambar untuk galeri.');
        }

        $file = $this->request->getFile('image');
        $imageName = null;
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $imageName = $file->getRandomName();
            $file->move('uploads/services', $imageName);
        }

        $galleryNames = [];
        if ($galleryFiles) {
            foreach ($galleryFiles as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $name = $img->getRandomName();
                    $img->move('uploads/services', $name);
                    $galleryNames[] = $name;
                }
            }
        }

        $this->serviceModel->save([
            'category'          => $category,
            'title'             => $this->request->getPost('title'),
            'slug'              => url_title($this->request->getPost('title'), '-', true),
            'short_description' => $this->request->getPost('short_description'),
            'content'           => $this->request->getPost('content'),
            'image'             => $imageName,
            'gallery'           => json_encode($galleryNames),
            'is_active'         => 1
        ]);

        return redirect()->to('/panel-pab/services/' . $category)->with('success', 'Item layanan berhasil ditambahkan.');
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
        return view('panel-pab/services/form', $data);
    }

    public function update($id)
    {
        $serviceLama = $this->serviceModel->find($id);
        $category    = $this->request->getPost('category');

        $currentGallery = json_decode($serviceLama['gallery'] ?? '[]', true);
        if (!is_array($currentGallery)) $currentGallery = [];

        $deleteImages = $this->request->getPost('delete_gallery') ?? [];
        $remainingImages = count($currentGallery) - count($deleteImages);

        $galleryFiles = $this->request->getFileMultiple('gallery');
        $newUploadCount = 0;
        if ($galleryFiles) {
            foreach ($galleryFiles as $file) {
                if ($file->isValid()) $newUploadCount++;
            }
        }

        $totalImages = $remainingImages + $newUploadCount;
        if ($totalImages > 5) {
            return redirect()->back()->withInput()->with('error', "Gagal! Total gambar melebihi batas. Anda memiliki $remainingImages gambar tersisa dan mencoba upload $newUploadCount baru. Maksimal total 5.");
        }

        $file = $this->request->getFile('image');
        $imageName = $serviceLama['image'];
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if ($imageName && file_exists('uploads/services/' . $imageName)) unlink('uploads/services/' . $imageName);
            $imageName = $file->getRandomName();
            $file->move('uploads/services', $imageName);
        }

        foreach ($deleteImages as $delImg) {
            if (($key = array_search($delImg, $currentGallery)) !== false) {
                if (file_exists('uploads/services/' . $delImg)) unlink('uploads/services/' . $delImg);
                unset($currentGallery[$key]);
            }
        }
        $currentGallery = array_values($currentGallery);

        if ($galleryFiles) {
            foreach ($galleryFiles as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $name = $img->getRandomName();
                    $img->move('uploads/services', $name);
                    $currentGallery[] = $name;
                }
            }
        }

        $this->serviceModel->update($id, [
            'title'             => $this->request->getPost('title'),
            'slug'              => url_title($this->request->getPost('title'), '-', true),
            'short_description' => $this->request->getPost('short_description'),
            'content'           => $this->request->getPost('content'),
            'image'             => $imageName,
            'gallery'           => json_encode($currentGallery)
        ]);

        return redirect()->to('/panel-pab/services/' . $category)->with('success', 'Item berhasil diupdate.');
    }

    public function delete($id)
    {
        $data = $this->serviceModel->find($id);
        if ($data) {
            $this->serviceModel->delete($id);
            return redirect()->to('/panel-pab/services/' . $data['category'])->with('success', 'Item dihapus.');
        }
        return redirect()->back();
    }
}
