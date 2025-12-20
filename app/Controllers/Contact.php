<?php

namespace App\Controllers;

use App\Models\SiteSettingModel;

class Contact extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $settingModel = new SiteSettingModel();

        $data = [
            'title'    => 'Kontak Kami | PT. Pesona Adi Batara',
            'intro'    => $db->table('page_sections')->where('section_key', 'contact_intro')->get()->getRowArray(),
            'maps'     => $settingModel->getVal('company_maps'),
            'address'  => $settingModel->getVal('address'),  // Pastikan key di DB 'address' atau sesuaikan
            'phone'    => $settingModel->getVal('phone'),
            'email'    => $settingModel->getVal('email'),
            'whatsapp' => $settingModel->getVal('whatsapp'),
        ];

        return view('contact', $data);
    }

    public function send()
    {
        $db = \Config\Database::connect();
        
        // Validasi Simple
        if (!$this->validate([
            'name' => 'required',
            'email' => 'required|valid_email',
            'message' => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Mohon lengkapi data dengan benar.');
        }

        $data = [
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'subject' => $this->request->getPost('subject'),
            'message' => $this->request->getPost('message'),
        ];

        $db->table('messages')->insert($data);

        return redirect()->to('/contact')->with('success', 'Pesan Anda telah terkirim! Tim kami akan segera menghubungi Anda.');
    }
}