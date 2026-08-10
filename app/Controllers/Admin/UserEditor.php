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
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/panel-pab/dashboard')->with('error', 'Akses ditolak! Anda bukan Super Admin.');
        }

        $data = [
            'title' => 'Kelola Administrator',
            'users' => $this->userModel->findAll()
        ];
        return view('panel-pab/users/index', $data);
    }

    public function create()
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        return view('panel-pab/users/form', ['title' => 'Tambah Admin Baru']);
    }

    public function save()
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        if (!$this->validate([
            'name'     => 'required',
            'username' => 'required|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role'     => 'required'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali data Anda. Username & Email harus unik, Password min 6 karakter.');
        }

        $result = $this->userModel->insert([
            'username'  => $this->request->getPost('username'),
            'fullname'  => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ]);

        if ($result === false) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan user. Coba lagi.');
        }

        log_activity('Tambah User', $this->request->getPost('name'), 'success');

        return redirect()->to('/panel-pab/users')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        $data = [
            'title' => 'Edit Administrator',
            'user'  => $this->userModel->find($id)
        ];
        return view('panel-pab/users/form', $data);
    }

    public function update($id)
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        // Validasi username & email unique, kecuali milik user yang sedang diedit
        if (!$this->validate([
            'username' => "required|is_unique[users.username,id,{$id}]",
            'email'    => "required|valid_email|is_unique[users.email,id,{$id}]",
        ])) {
            return redirect()->back()->withInput()->with('error', 'Username atau Email sudah digunakan oleh user lain.');
        }

        $dataUpdate = [
            'username'  => $this->request->getPost('username'),
            'fullname'  => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'role'      => $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0
        ];

        // Hanya update password jika diisi
        $newPassword = $this->request->getPost('password');
        if (!empty($newPassword)) {
            $dataUpdate['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        $result = $this->userModel->update($id, $dataUpdate);

        if ($result === false) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui data user. Coba lagi.');
        }

        log_activity('Edit User', $this->request->getPost('name'), 'info');

        return redirect()->to('/panel-pab/users')->with('success', 'Data user berhasil diperbarui.');
    }

    public function delete($id)
    {
        if (session()->get('role') !== 'superadmin') return redirect()->back();

        if ($id == session()->get('id')) {
            return redirect()->back()->with('error', 'Anda tidak bisa menghapus akun sendiri saat sedang login.');
        }

        $deletedUser = $this->userModel->find($id);
        $this->userModel->delete($id);

        log_activity('Hapus User', $deletedUser['fullname'] ?? 'ID: ' . $id, 'danger');

        return redirect()->to('/panel-pab/users')->with('success', 'User dihapus.');
    }


    // --- BAGIAN 2: PROFIL SAYA (UNTUK SEMUA ADMIN) ---

    public function profile()
    {
        $myId = session()->get('id');
        $data = [
            'title' => 'Profil Saya',
            'user'  => $this->userModel->find($myId)
        ];
        return view('panel-pab/users/profile', $data);
    }

    public function updateProfile()
    {
        $myId = session()->get('id');

        // Validasi Avatar (opsional, hanya jika file dikirim)
        $rules = [
            'name'   => 'required',
            'avatar' => 'is_image[avatar]|max_size[avatar,2048]|mime_in[avatar,image/jpg,image/jpeg,image/png]|ext_in[avatar,jpg,jpeg,png]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Gagal update. Pastikan format gambar benar (JPG/PNG, maks 2MB).');
        }

        $dataUpdate = [
            'fullname' => $this->request->getPost('name'),
        ];

        // Hanya update password jika diisi
        $pass = $this->request->getPost('password');
        if (!empty($pass)) {
            $dataUpdate['password'] = password_hash($pass, PASSWORD_DEFAULT);
        }

        // Upload Avatar jika ada file baru
        $file = $this->request->getFile('avatar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/avatars', $newName);
            $dataUpdate['avatar'] = $newName;
            session()->set('avatar', $newName);
        }

        // Gunakan update($id, $data) langsung - tanpa 'id' di dalam array data
        $result = $this->userModel->update($myId, $dataUpdate);

        if ($result === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan perubahan. Coba lagi.');
        }

        // Sinkronisasi nama di session
        session()->set('name', $dataUpdate['fullname']);

        return redirect()->to('/panel-pab/profile')->with('success', 'Profil berhasil diperbarui!');
    }
}
