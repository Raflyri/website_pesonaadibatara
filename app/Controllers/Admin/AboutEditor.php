<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SiteSettingModel;

class AboutEditor extends BaseController
{
    protected $db;
    protected $settingModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->settingModel = new SiteSettingModel();
    }

    public function index()
    {
        $history = $this->db->table('page_sections')->where('section_key', 'about_history')->get()->getRowArray();
        $vision  = $this->db->table('page_sections')->where('section_key', 'about_vision')->get()->getRowArray();
        $mission = $this->db->table('page_sections')->where('section_key', 'about_mission')->get()->getRowArray();
        $linkSetting = $this->db->table('site_settings')->where('setting_key', 'company_profile_link')->get()->getRowArray();
        $fileSetting = $this->db->table('site_settings')->where('setting_key', 'company_profile')->get()->getRowArray();

        $data = [
            'title'   => 'Kelola Halaman Tentang Kami',
            'history' => $history,
            'vision'  => $vision,
            'mission' => $mission,
            'compro_link' => $linkSetting['setting_value'] ?? '',
            'compro_file' => $fileSetting['setting_value'] ?? ''
        ];

        return view('panel-pab/about/index', $data);
    }

    public function update()
    {
        // 1. Validasi Input
        $validationRules = [
            'compro_file' => [
                'rules' => 'max_size[compro_file,5120]|ext_in[compro_file,pdf]', 
                'errors' => [
                    'max_size' => 'File terlalu besar (>5MB). Mohon upload ke Google Drive dan masukkan Link-nya di kolom Opsi 2.',
                    'ext_in'   => 'Format file harus PDF.'
                ]
            ]
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Update Bagian History (Sejarah)
        $historyData = [
            'title_id'   => $this->request->getPost('history_title_id'),
            // 'title_en'   => ... (jika ada),
            'content_id' => $this->request->getPost('history_content_id'),
            // 'content_en' => ... (jika ada),
        ];

        $fileHistory = $this->request->getFile('history_image');
        if ($fileHistory && $fileHistory->isValid() && !$fileHistory->hasMoved()) {
            $newName = $fileHistory->getRandomName();
            $fileHistory->move('uploads/about', $newName);
            $historyData['media_url'] = $newName;
        }

        $this->db->table('page_sections')->where('section_key', 'about_history')->update($historyData);

        // 3. Update Visi & Misi
        $visionData = [
            'content_id' => $this->request->getPost('vision_id'),
            'content_en' => $this->request->getPost('vision_en'),
        ];
        $this->db->table('page_sections')->where('section_key', 'about_vision')->update($visionData);

        $missionData = [
            'content_id' => $this->request->getPost('mission_id'),
            'content_en' => $this->request->getPost('mission_en'),
        ];
        $this->db->table('page_sections')->where('section_key', 'about_mission')->update($missionData);

        // ---------------------------------------------------------
        // 4. Update Link Company Profile (INI YANG KAKAK CARI)
        // ---------------------------------------------------------
        $linkInput = $this->request->getPost('compro_link');
        
        // Ambil data lama untuk dapatkan ID-nya
        $oldLink = $this->settingModel->where('setting_key', 'company_profile_link')->first();

        $dataLink = [
            'setting_key'   => 'company_profile_link',
            'setting_value' => $linkInput // ✅ SUDAH DIPERBAIKI (sebelumnya 'value')
        ];

        if ($oldLink) {
            $dataLink['id'] = $oldLink['id'];
        }
        $this->settingModel->save($dataLink);


        // ---------------------------------------------------------
        // 5. Update File PDF Company Profile
        // ---------------------------------------------------------
        $fileCompro = $this->request->getFile('compro_file');

        if ($fileCompro && $fileCompro->isValid() && !$fileCompro->hasMoved()) {

            $oldSetting = $this->settingModel->where('setting_key', 'company_profile')->first();
            
            // Perbaiki pengambilan value lama (gunakan setting_value)
            $oldFilename = $oldSetting['setting_value'] ?? null; 

            // Hapus file lama jika ada
            if ($oldFilename && file_exists('uploads/doc/' . $oldFilename)) {
                unlink('uploads/doc/' . $oldFilename);
            }

            // Upload file baru
            $newName = 'compro-' . $fileCompro->getRandomName();
            $fileCompro->move('uploads/doc', $newName);

            $dataFile = [
                'setting_key'   => 'company_profile',
                'setting_value' => $newName // ✅ SUDAH DIPERBAIKI (konsisten pakai setting_value)
            ];

            if ($oldSetting) {
                $dataFile['id'] = $oldSetting['id'];
            }
            $this->settingModel->save($dataFile);
        }

        return redirect()->to('/panel-pab/about-editor')->with('success', 'Konten Tentang Kami berhasil diperbarui!');
    }
}
