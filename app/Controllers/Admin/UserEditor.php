<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserEditor extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // --- BAGIAN 1: MANAJEMEN USER (KHUSUS SUPER ADMIN) ---

    public function index()
    {
        // Cek Role: Hanya Super Admin yang boleh masuk sini
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/admin/dashboard')->with('error', 'Akses ditolak! Anda bukan Super Admin.');
        }

        $data = [
            'title' => 'Kelola Administrator',
            'users' => $this->userModel->findAll()
        ];
        return view('admin/users/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();
        
        return view('admin/users/form', ['title' => 'Tambah Admin Baru']);
    }

    public function save()
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        // Validasi
        if (!$this->validate([
            'name'     => 'required',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length(6)',
            'role'     => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali data Anda. Email harus unik & Password min 6 karakter.');
        }

        // Simpan Data
        $this->userModel->save([
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), // Hash Password
            'role'      => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ]);

        return redirect()->to('/admin/users')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        $data = [
            'title' => 'Edit Administrator',
            'user'  => $this->userModel->find($id)
        ];
        return view('admin/users/form', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        // Logic Update Password (Hanya update jika diisi)
        $dataUpdate = [
            'id'        => $id,
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'role'      => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $dataUpdate['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $this->userModel->save($dataUpdate);
        return redirect()->to('/admin/users')->with('success', 'Data user diperbarui.');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        // Cegah Hapus Diri Sendiri
        if ($id == session()->get('id')) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri saat sedang login.');
        }

        $this->userModel->delete($id);
        return redirect()->to('/admin/users')->with('success', 'User dihapus.');
    }


    // --- BAGIAN 2: PROFIL SAYA (UNTUK SEMUA ADMIN) ---

    public function profile()
    {
        $myId = session()->get('id');
        $data = [
            'title' => 'Profil Saya',
            'user'  => $this->userModel->find($myId)
        ];
        return view('admin/users/profile', $data);
    }

    public function updateProfile()
    {
        $myId = session()->get('id');
        
        // Validasi Avatar
        $rules = [
            'name' => 'required',
            'avatar' => 'is_image[avatar]|max_size[avatar,2048]|mime_in[avatar,image/jpg,image/jpeg,image/png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Gagal update. Pastikan format gambar benar.');
        }

        $dataUpdate = [
            'id'   => $myId,
            'fullname' => $this->request->getPost('name'),
        ];

        // Cek Ganti Password
        $pass = $this->request->getPost('password');
        if(!empty($pass)){
            $dataUpdate['password'] = password_hash($pass, PASSWORD_DEFAULT);
        }

        // Upload Avatar
        $file = $this->request->getFile('avatar');
        if($file && $file->isValid() && !$file->hasMoved()){
            $newName = $file->getRandomName();
            $file->move('uploads/avatars', $newName);
            $dataUpdate['avatar'] = $newName;
            
            // Update session avatar biar langsung berubah di header
            session()->set('avatar', $newName); 
        }

        $this->userModel->save($dataUpdate);
        
        // Update session nama
        session()->set('name', $dataUpdate['name']);

        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui!');
    }
}