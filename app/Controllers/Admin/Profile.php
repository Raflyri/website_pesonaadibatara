<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // Ambil ID user yang sedang login dari session
        $userId = session()->get('admin_id'); 

        // Ambil data terbaru dari database
        $user = $this->db->table('users')->where('id', $userId)->get()->getRowArray();

        $data = [
            'title' => 'Profil Administrator',
            'user'  => $user
        ];

        return view('admin/profile/index', $data);
    }

    public function update()
    {
        $userId = session()->get('admin_id');
        
        // 1. Validasi Input Dasar
        if (!$this->validate([
            'name'   => 'required|min_length(3)',
            'email'  => 'required|valid_email',
            'avatar' => 'is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]'
        ])) {
            return redirect()->back()->withInput()->with('error', 'Cek kembali inputan Anda. (Gambar max 2MB)');
        }

        // 2. Siapkan Data Update
        $dataUpdate = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // 3. Cek Upload Foto Baru
        $fileAvatar = $this->request->getFile('avatar');
        if ($fileAvatar && $fileAvatar->isValid() && !$fileAvatar->hasMoved()) {
            // Hapus foto lama jika ada (dan bukan default)
            $oldUser = $this->db->table('users')->where('id', $userId)->get()->getRowArray();
            if ($oldUser['avatar'] && file_exists('uploads/users/' . $oldUser['avatar'])) {
                unlink('uploads/users/' . $oldUser['avatar']);
            }

            // Upload baru
            $newName = $fileAvatar->getRandomName();
            $fileAvatar->move('uploads/users', $newName);
            $dataUpdate['avatar'] = $newName;
        }

        // 4. Eksekusi Update
        $this->db->table('users')->where('id', $userId)->update($dataUpdate);

        // Update Session juga biar nama di pojok kanan atas berubah realtime
        session()->set('admin_name', $dataUpdate['name']);
        if(isset($dataUpdate['avatar'])) {
            session()->set('admin_avatar', $dataUpdate['avatar']);
        }

        return redirect()->to('/admin/profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function password()
    {
        $userId = session()->get('admin_id');
        
        // 1. Validasi Password
        if (!$this->validate([
            'old_password'     => 'required',
            'new_password'     => 'required|min_length[6]',
            'confirm_password' => 'matches[new_password]'
        ])) {
            return redirect()->back()->with('error_password', 'Password baru tidak cocok atau kurang dari 6 karakter.');
        }

        // 2. Cek Password Lama Benar/Salah
        $user = $this->db->table('users')->where('id', $userId)->get()->getRowArray();
        $oldPassInput = $this->request->getPost('old_password');

        if (!password_verify($oldPassInput, $user['password'])) {
            return redirect()->back()->with('error_password', 'Password lama Anda salah!');
        }

        // 3. Update Password Baru
        $newPassHash = password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT);
        
        $this->db->table('users')->where('id', $userId)->update([
            'password' => $newPassHash
        ]);

        return redirect()->to('/admin/profile')->with('success', 'Password berhasil diubah!');
    }
}