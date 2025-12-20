<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        // Ambil Data Lain (Sejarah, Visi, Misi) ... (sama seperti sebelumnya)
        $history = $db->table('page_sections')->where('section_key', 'about_history')->get()->getRowArray();
        $vision  = $db->table('page_sections')->where('section_key', 'about_vision')->get()->getRowArray();
        $mission = $db->table('page_sections')->where('section_key', 'about_mission')->get()->getRowArray();

        // 1. Ambil Semua Tim
        $allTeams = $db->table('teams')->orderBy('level', 'ASC')->orderBy('urutan', 'ASC')->get()->getResultArray();

        // 2. FUNGSI REKURSIF (Membuat Flat Data jadi Tree)
        $tree = $this->buildTree($allTeams);

        $data = [
            'title'   => 'Tentang Kami | PT. Pesona Adi Batara',
            'history' => $history,
            'vision'  => $vision,
            'mission' => $mission,
            'teams'   => $tree // Kirim data yang sudah berbentuk Pohon
        ];

        return view('about', $data);
    }

    // Fungsi Helper untuk menyusun Array Parent-Child
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
