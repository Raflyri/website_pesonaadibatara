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
        $tagline = $this->settingModel->getVal('company_tagline');
        $taglineFont = $this->settingModel->getVal('company_tagline_font');
        $taglineSize = $this->settingModel->getVal('company_tagline_size');
        $taglineColor = $this->settingModel->getVal('company_tagline_color');
        $showTagline = $this->settingModel->getVal('show_company_tagline');
        $companyIcon = $this->settingModel->getVal('company_icon');
        $companyName = $this->settingModel->getVal('company_name');

        $data = [
            'title'   => 'Kelola Halaman Tentang Kami',
            'history' => $history,
            'vision'  => $vision,
            'mission' => $mission,
            'compro_link' => $linkSetting['setting_value'] ?? '',
            'compro_file' => $fileSetting['setting_value'] ?? '',
            'company_tagline' => $tagline,
            'company_tagline_font' => $taglineFont,
            'company_tagline_size' => $taglineSize,
            'company_tagline_color' => $taglineColor,
            'show_company_tagline' => $showTagline ?? '1',
            'company_icon' => $companyIcon,
            'company_name'    => $companyName
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

        // 4. Update Link Company Profile 
        $linkInput = $this->request->getPost('compro_link');

        $oldLink = $this->settingModel->where('setting_key', 'company_profile_link')->first();

        $dataLink = [
            'setting_key'   => 'company_profile_link',
            'setting_value' => $linkInput
        ];

        if ($oldLink) {
            $dataLink['id'] = $oldLink['id'];
        }
        $this->settingModel->save($dataLink);


        // 5. Update File PDF Company Profile
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
                'setting_value' => $newName
            ];

            if ($oldSetting) {
                $dataFile['id'] = $oldSetting['id'];
            }
            $this->settingModel->save($dataFile);
        }

        //6. Update Tagline Perusahaan
        $taglineInput = $this->request->getPost('company_tagline');
        if ($taglineInput !== null) {
            $oldTagline = $this->settingModel->where('setting_key', 'company_tagline')->first();
            $dataTagline = [
                'setting_key'   => 'company_tagline',
                'setting_value' => $taglineInput
            ];

            if ($oldTagline) {
                $dataTagline['id'] = $oldTagline['id'];
            }
            $this->settingModel->save($dataTagline);
        }

        //7. Update Font Tagline
        $fontInput = $this->request->getPost('company_tagline_font');
        if ($fontInput !== null) {
            $oldFont = $this->settingModel->where('setting_key', 'company_tagline_font')->first();
            $dataFont = [
                'setting_key'   => 'company_tagline_font',
                'setting_value' => $fontInput
            ];

            if ($oldFont) {
                $dataFont['id'] = $oldFont['id'];
            }
            $this->settingModel->save($dataFont);
        }

        // Update Font Size
        $fontSizeInput = $this->request->getPost('company_tagline_size');
        if ($fontSizeInput !== null) {
            $oldSize = $this->settingModel->where('setting_key', 'company_tagline_size')->first();
            $dataSize = [
                'setting_key'   => 'company_tagline_size',
                'setting_value' => $fontSizeInput
            ];
            if ($oldSize) $dataSize['id'] = $oldSize['id'];
            $this->settingModel->save($dataSize);
        }

        // Update Font Color
        $fontColorInput = $this->request->getPost('company_tagline_color');
        if ($fontColorInput !== null) {
            $oldColor = $this->settingModel->where('setting_key', 'company_tagline_color')->first();
            $dataColor = [
                'setting_key'   => 'company_tagline_color',
                'setting_value' => $fontColorInput
            ];
            if ($oldColor) $dataColor['id'] = $oldColor['id'];
            $this->settingModel->save($dataColor);
        }

        // Update Show Tagline Toggle
        $showTaglineInput = $this->request->getPost('show_company_tagline') ? '1' : '0';
        $oldShowTagline = $this->settingModel->where('setting_key', 'show_company_tagline')->first();
        $dataShowTagline = [
            'setting_key'   => 'show_company_tagline',
            'setting_value' => $showTaglineInput
        ];
        if ($oldShowTagline) $dataShowTagline['id'] = $oldShowTagline['id'];
        $this->settingModel->save($dataShowTagline);

        // 8. Handle Upload Company Icon (Logo)
        $fileIcon = $this->request->getFile('company_icon');

        // Cek validasi file
        if ($fileIcon && $fileIcon->isValid() && !$fileIcon->hasMoved()) {

            $mime = $fileIcon->getMimeType();
            // Pastikan yang diupload adalah gambar
            if (strpos($mime, 'image') !== false) {

                // 1. Upload File
                $newIconName = $fileIcon->getRandomName();

                // Pindahkan ke folder public/assets/img/
                // Pastikan path ini benar sesuai struktur folder public kakak
                $fileIcon->move('assets/img', $newIconName);

                // 2. Siapkan Data Array untuk Database
                $oldIcon = $this->settingModel->where('setting_key', 'company_icon')->first();

                $dataIcon = [
                    'setting_key'   => 'company_icon',
                    'setting_value' => $newIconName
                ];

                // Jika sudah ada data lama, tambahkan ID agar menjadi UPDATE (bukan Insert baru)
                if ($oldIcon) {
                    $dataIcon['id'] = $oldIcon['id'];
                }

                // 3. Simpan (Parameter harus Array)
                $this->settingModel->save($dataIcon);
            }
        }


        return redirect()->to('/panel-pab/about-editor')->with('success', 'Konten Tentang Kami berhasil diperbarui!');
    }
}
