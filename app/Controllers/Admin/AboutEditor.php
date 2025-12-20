<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class AboutEditor extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil 3 data sekaligus
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
        // 1. UPDATE SEJARAH
        $historyData = [
            'title_id'   => $this->request->getPost('history_title_id'),
            'title_en'   => $this->request->getPost('history_title_en'),
            'content_id' => $this->request->getPost('history_content_id'),
            'content_en' => $this->request->getPost('history_content_en'),
        ];
        
        // Handle Upload Foto Sejarah
        $fileHistory = $this->request->getFile('history_image');
        if ($fileHistory && $fileHistory->isValid() && !$fileHistory->hasMoved()) {
            $newName = $fileHistory->getRandomName();
            $fileHistory->move('uploads/about', $newName);
            $historyData['media_url'] = $newName;
        }
        
        $this->db->table('page_sections')->where('section_key', 'about_history')->update($historyData);

        // 2. UPDATE VISI
        $visionData = [
            'content_id' => $this->request->getPost('vision_id'),
            'content_en' => $this->request->getPost('vision_en'),
        ];
        $this->db->table('page_sections')->where('section_key', 'about_vision')->update($visionData);

        // 3. UPDATE MISI
        $missionData = [
            'content_id' => $this->request->getPost('mission_id'),
            'content_en' => $this->request->getPost('mission_en'),
        ];
        $this->db->table('page_sections')->where('section_key', 'about_mission')->update($missionData);

        return redirect()->to('/admin/about-editor')->with('success', 'Konten Tentang Kami berhasil diperbarui!');
    }
}