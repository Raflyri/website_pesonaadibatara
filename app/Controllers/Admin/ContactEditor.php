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
            'title'    => 'Kelola Halaman Kontak & Pesan',
            'intro'    => $intro,
            'maps'     => $maps,
            'messages' => $messages
        ];

        return view('admin/contact/index', $data);
    }
}