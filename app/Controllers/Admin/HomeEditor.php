<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class HomeEditor extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil data section 'home_why_choose_us'
        $section = $this->db->table('page_sections')
                            ->where('section_key', 'home_why_choose_us')
                            ->get()->getRowArray();

        // Jika belum ada data (kosong), kita buat dummy object biar gak error
        if (!$section) {
            $section = [
                'title_id' => '', 'title_en' => '',
                'content_id' => '', 'content_en' => '',
                'media_url' => ''
            ];
        }

        $data = [
            'title' => 'Kelola Halaman Beranda',
            'section' => $section
        ];

        return view('admin/home/index', $data);
    }

    public function update()
    {
        // 1. Ambil Inputan Teks
        $data = [
            'title_id' => $this->request->getPost('title_id'),
            'title_en' => $this->request->getPost('title_en'),
            'content_id' => $this->request->getPost('content_id'),
            'content_en' => $this->request->getPost('content_en'),
        ];

        // 2. PROSES MEDIA (GAMBAR / VIDEO)
        $mediaFile = $this->request->getFile('video_file'); // Kita pakai nama field yg sama biar ga ubah view banyak2

        if ($mediaFile && $mediaFile->isValid() && !$mediaFile->hasMoved()) {
            
            // A. VALIDASI FORMAT (Video & Gambar)
            $mimeType = $mediaFile->getMimeType();
            $allowedMimes = ['video/mp4', 'image/jpeg', 'image/png', 'image/webp'];
            
            if (!in_array($mimeType, $allowedMimes)) {
                return redirect()->back()->with('error', 'Format file harus MP4, JPG, atau PNG!');
            }

            // B. HAPUS FILE LAMA (Supaya Storage Tidak Bengkak)
            $oldData = $this->db->table('page_sections')->where('section_key', 'home_why_choose_us')->get()->getRowArray();
            if ($oldData && !empty($oldData['media_url'])) {
                // Cek apakah file lama ada di folder uploads/home?
                $oldFilePath = 'uploads/home/' . $oldData['media_url'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // HAPUS FILE LAMA
                }
            }

            // C. UPLOAD FILE BARU
            // Kita simpan semua (img/vid) di satu folder 'uploads/home' biar rapi
            $newName = $mediaFile->getRandomName();
            $mediaFile->move('uploads/home', $newName);

            $data['media_url'] = $newName;
        }

        // 3. Simpan ke Database
        $builder = $this->db->table('page_sections');
        $exists = $builder->where('section_key', 'home_why_choose_us')->countAllResults();

        if ($exists > 0) {
            $builder->where('section_key', 'home_why_choose_us')->update($data);
        } else {
            $data['section_key'] = 'home_why_choose_us';
            $builder->insert($data);
        }

        return redirect()->to('/admin/home-editor')->with('success', 'Konten Beranda berhasil diperbarui!');
    }
}