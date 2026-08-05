<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $settingModel = new \App\Models\SiteSettingModel();

        $history = $db->table('page_sections')->where('section_key', 'about_history')->get()->getRowArray();
        $vision  = $db->table('page_sections')->where('section_key', 'about_vision')->get()->getRowArray();
        $mission = $db->table('page_sections')->where('section_key', 'about_mission')->get()->getRowArray();

        // Sudah terurut level 1 -> 5, lalu urutan manual per level.
        $teams = $db->table('teams')->orderBy('level', 'ASC')->orderBy('urutan', 'ASC')->get()->getResultArray();

        $fileRow = $settingModel->where('setting_key', 'company_profile')->first();
        $linkRow = $settingModel->where('setting_key', 'company_profile_link')->first();

        $data = [
            'title'   => 'Tentang Kami | PT. Pesona Adi Batara',
            'history' => $history,
            'vision'  => $vision,
            'mission' => $mission,
            'teams'   => $teams,
            'compro_file' => $fileRow['setting_value'] ?? null,
            'compro_link' => $linkRow['setting_value'] ?? null,
        ];

        return view('about', $data);
    }
}
