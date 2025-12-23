<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PartnersModel; // Pastikan Model ini sudah dibuat (sesuai chat sebelumnya)

class Partners extends BaseController
{
    protected $partnersModel;

    public function __construct()
    {
        $this->partnersModel = new PartnersModel();
    }

    public function index()
    {
        $data = [
            'title'    => 'Kelola Partner & Klien',
            // Urutkan berdasarkan display_order biar sesuai keinginan user
            'partners' => $this->partnersModel->orderBy('display_order', 'ASC')->findAll()
        ];
        return view('admin/partners/index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Partner Baru'];
        return view('admin/partners/form', $data);
    }

    public function save($id = null)
    {
        // 1. Validasi
        $rules = [
            'partner_name'  => 'required',
            'display_order' => 'required|numeric',
        ];

        // Validasi Gambar: Wajib jika Create (id null), Opsional jika Edit
        if (!$id) {
            $rules['partner_logo'] = [
                'rules' => 'uploaded[partner_logo]|is_image[partner_logo]|mime_in[partner_logo,image/jpg,image/jpeg,image/png,image/webp]|max_size[partner_logo,2048]',
                'errors' => [
                    'uploaded' => 'Logo partner wajib diupload.',
                    'max_size' => 'Ukuran maksimal 2MB.',
                    'mime_in'  => 'Format harus PNG, JPG, atau WEBP (Transparan lebih baik).'
                ]
            ];
        } else {
            // Kalau edit, cek cuma validasi kalau ada file masuk
            $rules['partner_logo'] = [
                'rules' => 'is_image[partner_logo]|mime_in[partner_logo,image/jpg,image/jpeg,image/png,image/webp]|max_size[partner_logo,2048]',
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Siapkan Data
        $data = [
            'partner_name'  => $this->request->getPost('partner_name'),
            'partner_url'   => $this->request->getPost('partner_url'), // Boleh kosong
            'display_order' => $this->request->getPost('display_order'),
            'is_active'     => $this->request->getPost('is_active') ? 1 : 0,
        ];

        // 3. Handle Upload Logo
        $fileLogo = $this->request->getFile('partner_logo');

        if ($fileLogo && $fileLogo->isValid() && !$fileLogo->hasMoved()) {
            // A. Hapus logo lama jika edit
            if ($id) {
                $oldData = $this->partnersModel->find($id);
                if ($oldData['partner_logo'] && file_exists('uploads/partners/' . $oldData['partner_logo'])) {
                    unlink('uploads/partners/' . $oldData['partner_logo']);
                }
            }

            // B. Upload & Resize
            $newName = $fileLogo->getRandomName();
            
            // Pindahkan file original dulu
            $fileLogo->move('uploads/partners', $newName);

            // C. Resize Image (Service CI4) - Biar ringan
            try {
                $imageService = \Config\Services::image();
                $imageService->withFile('uploads/partners/' . $newName)
                             ->resize(300, 150, true, 'width') // Max lebar 300px, tinggi menyesuaikan
                             ->save('uploads/partners/' . $newName);
            } catch (\Exception $e) {
                // Jika resize gagal, biarkan file asli (silent fail)
            }

            $data['partner_logo'] = $newName;
        }

        // 4. Simpan ke DB
        if ($id) {
            $this->partnersModel->update($id, $data);
        } else {
            $this->partnersModel->insert($data);
        }

        return redirect()->to('/admin/partners')->with('success', 'Data Partner berhasil disimpan.');
    }

    public function edit($id)
    {
        $partner = $this->partnersModel->find($id);
        if (!$partner) return redirect()->to('/admin/partners');

        $data = [
            'title'   => 'Edit Partner',
            'partner' => $partner
        ];
        return view('admin/partners/form', $data);
    }

    public function delete($id)
    {
        $partner = $this->partnersModel->find($id);
        if (!$partner) return redirect()->to('/admin/partners');

        // Hapus file fisik
        if ($partner['partner_logo'] && file_exists('uploads/partners/' . $partner['partner_logo'])) {
            unlink('uploads/partners/' . $partner['partner_logo']);
        }

        $this->partnersModel->delete($id);
        return redirect()->to('/admin/partners')->with('success', 'Partner dihapus.');
    }
}