<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TeamModel;

class Team extends BaseController
{
    protected $teamModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Direksi & Tim',
            'teams' => $this->teamModel->orderBy('urutan', 'ASC')->findAll()
        ];
        return view('admin/team/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Direksi Baru',
            // Kirim data karyawan lain untuk jadi pilihan atasan
            'parents' => $this->teamModel->orderBy('name', 'ASC')->findAll() 
        ];
        return view('admin/team/form', $data);
    }

    public function save($id = null)
    {
        // 1. Validasi
        if (!$this->validate([
            'name' => 'required',
            'position_id' => 'required',
            'image' => [
                'rules' => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
                'errors' => [
                    'max_size' => 'Maksimal ukuran gambar 2MB',
                    'mime_in' => 'Format harus JPG atau PNG'
                ]
            ]
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Siapkan Data
        $data = [
            'name' => $this->request->getPost('name'),
            'position_id' => $this->request->getPost('position_id'),
            'position_en' => $this->request->getPost('position_en'),
            'level' => $this->request->getPost('level'),
            'urutan' => $this->request->getPost('urutan'),
            'parent_id' => $this->request->getPost('parent_id'), // <--- TAMBAHAN INI
        ];

        // 3. Handle Upload Foto
        $fileImage = $this->request->getFile('image');
        
        if ($fileImage && $fileImage->isValid() && !$fileImage->hasMoved()) {
            // Hapus foto lama jika edit
            if ($id) {
                $oldData = $this->teamModel->find($id);
                if ($oldData['image'] && file_exists('uploads/teams/' . $oldData['image'])) {
                    unlink('uploads/teams/' . $oldData['image']);
                }
            }

            $newName = $fileImage->getRandomName();
            $fileImage->move('uploads/teams', $newName);
            $data['image'] = $newName;
        }

        // 4. Simpan
        if ($id) {
            $this->teamModel->update($id, $data);
        } else {
            $this->teamModel->insert($data);
        }

        return redirect()->to('/admin/team')->with('success', 'Data Direksi berhasil disimpan.');
    }

    public function edit($id)
    {
        $team = $this->teamModel->find($id);
        if (!$team) return redirect()->to('/admin/team');

        $data = [
            'title' => 'Edit Direksi',
            'team' => $team,
            // Kirim data karyawan lain (kecuali dirinya sendiri biar ga error loop)
            'parents' => $this->teamModel->where('id !=', $id)->orderBy('name', 'ASC')->findAll()
        ];
        return view('admin/team/form', $data);
    }

    public function delete($id)
    {
        $team = $this->teamModel->find($id);
        if ($team['image'] && file_exists('uploads/teams/' . $team['image'])) {
            unlink('uploads/teams/' . $team['image']);
        }
        $this->teamModel->delete($id);
        return redirect()->to('/admin/team')->with('success', 'Data berhasil dihapus.');
    }
}