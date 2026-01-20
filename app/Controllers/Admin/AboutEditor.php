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

        $data = [
            'title'   => 'Kelola Halaman Tentang Kami',
            'history' => $history,
            'vision'  => $vision,
            'mission' => $mission
        ];

        return view('admin/about/index', $data);
    }

    public function update()
    {
        $historyData = [
            'title_id'   => $this->request->getPost('history_title_id'),
            'title_en'   => $this->request->getPost('history_title_en'),
            'content_id' => $this->request->getPost('history_content_id'),
            'content_en' => $this->request->getPost('history_content_en'),
        ];

        $fileHistory = $this->request->getFile('history_image');
        if ($fileHistory && $fileHistory->isValid() && !$fileHistory->hasMoved()) {
            $newName = $fileHistory->getRandomName();
            $fileHistory->move('uploads/about', $newName);
            $historyData['media_url'] = $newName;
        }

        $this->db->table('page_sections')->where('section_key', 'about_history')->update($historyData);

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

        $fileCompro = $this->request->getFile('compro_file');

        if ($fileCompro && $fileCompro->isValid() && !$fileCompro->hasMoved()) {

            $oldSetting = $this->settingModel->where('key', 'company_profile')->first();
            $oldFilename = $oldSetting['value'] ?? null;

            if ($oldFilename && file_exists('uploads/doc/' . $oldFilename)) {
                unlink('uploads/doc/' . $oldFilename);
            }

            $newName = 'compro-' . $fileCompro->getRandomName();
            $fileCompro->move('uploads/doc', $newName);

            $dataSimpan = [
                'key'   => 'company_profile',
                'value' => $newName
            ];

            if ($oldSetting) {
                $dataSimpan['id'] = $oldSetting['id'];
            }

            $this->settingModel->save($dataSimpan);
        }

        return redirect()->to('/panel-pab/about-editor')->with('success', 'Konten Tentang Kami berhasil diperbarui!');
    }
}
