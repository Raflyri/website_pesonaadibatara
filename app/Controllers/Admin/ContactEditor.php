<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class ContactEditor extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    // 1. HALAMAN PENGATURAN & INBOX
    public function index()
    {
        // 1. Ambil Data dengan Validasi Null Safety
        $intro = $this->db->table('page_sections')->where('section_key', 'contact_intro')->get()->getRowArray();
        $maps  = $this->db->table('site_settings')->where('setting_key', 'company_maps')->get()->getRowArray();

        $sosmed = [];
        $keys = ['sosmed_instagram', 'sosmed_facebook', 'sosmed_linkedin', 'sosmed_youtube'];
        foreach ($keys as $key) {
            $row = $this->db->table('site_settings')->where('setting_key', $key)->get()->getRowArray();
            $sosmed[$key] = $row ? $row['setting_value'] : '#';
        }

        // JAGA-JAGA: Jika data database kosong, isi dengan array kosong biar View tidak error
        if (!$intro) {
            $intro = ['title_id' => '', 'title_en' => '', 'content_id' => '', 'content_en' => ''];
        }

        if (!$maps) {
            $maps = ['setting_value' => ''];
        }

        // 2. Ambil Pesan Masuk
        $messages = $this->db->table('messages')->orderBy('created_at', 'DESC')->get()->getResultArray();

        $data = [
            'title'    => 'Kelola Kontak & Sosmed',
            'intro'    => $intro,
            'maps'     => $maps,
            'sosmed'   => $sosmed,
            // [BARU] Kontak
            'contact'  => [
                'company_whatsapp' => $this->db->table('site_settings')->where('setting_key', 'company_whatsapp')->get()->getRow()->setting_value ?? '',
                'company_phone'    => $this->db->table('site_settings')->where('setting_key', 'company_phone')->get()->getRow()->setting_value ?? ''
            ],
            'messages' => $messages ?? []
        ];

        return view('panel-pab/contact/index', $data);
    }

    public function updateContent()
    {
        // ... kode update intro lama ...

        // ... kode update maps lama ...

        // [BARU] Update Social Media
        $sosmedKeys = ['sosmed_instagram', 'sosmed_facebook', 'sosmed_linkedin', 'sosmed_youtube'];
        foreach ($sosmedKeys as $key) {
            $val = $this->request->getPost($key);
            $this->db->table('site_settings')->where('setting_key', $key)->update(['setting_value' => $val]);
        }

        // [BARU] Update Kontak (WhatsApp & Phone)
        $contactKeys = ['company_whatsapp', 'company_phone'];
        foreach ($contactKeys as $key) {
            $val = $this->request->getPost($key);
            // Cek ada tidak, kalau tidak ada insert, kalau ada update
            $exists = $this->db->table('site_settings')->where('setting_key', $key)->countAllResults() > 0;

            if ($exists) {
                $this->db->table('site_settings')->where('setting_key', $key)->update(['setting_value' => $val]);
            } else {
                $this->db->table('site_settings')->insert(['setting_key' => $key, 'setting_value' => $val]);
            }
        }

        return redirect()->to('/panel-pab/contact-editor')->with('success', 'Informasi Kontak & Sosmed diperbarui!');
    }
}
