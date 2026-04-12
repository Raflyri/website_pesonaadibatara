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
            'maps'     => !empty($settingModel->getVal('company_maps')) 
                ? $settingModel->getVal('company_maps') 
                : 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1983.186835334752!2d106.8093116!3d-6.2039863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f69f20e5c5c7%3A0x6c51888350541705!2sThe%20Archies%20Sudirman!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid',
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