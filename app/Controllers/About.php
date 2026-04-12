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

        $allTeams = $db->table('teams')->orderBy('level', 'ASC')->orderBy('urutan', 'ASC')->get()->getResultArray();
        $tree = $this->buildTree($allTeams);

        $fileRow = $settingModel->where('setting_key', 'company_profile')->first();
        $linkRow = $settingModel->where('setting_key', 'company_profile_link')->first();

        $data = [
            'title'   => 'Tentang Kami | PT. Pesona Adi Batara',
            'history' => $history,
            'vision'  => $vision,
            'mission' => $mission,
            'teams'   => $tree,
            'compro_file' => $fileRow['setting_value'] ?? null,
            'compro_link' => $linkRow['setting_value'] ?? null,
        ];

        return view('about', $data);
    }

    private function buildTree(array $elements, $parentId = 0)
    {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
}
