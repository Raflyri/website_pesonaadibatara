<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    // UBAH NAMA DARI index() JADI login()
    public function login()
    {
        // Kalau sudah login, lempar ke dashboard admin yang benar
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }
        return view('auth/login');
    }

    public function process()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();
        $user = $db->table('users')->where('username', $username)->get()->getRowArray();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                // --- PERBAIKAN DISINI ---
                $sessData = [
                    'id'         => $user['id'],
                    'username'   => $user['username'],
                    'name'       => $user['fullname'], // Pastikan nama kolom di DB 'name' atau 'fullname'
                    'role'       => $user['role'], // <--- WAJIB DITAMBAHKAN
                    'avatar'     => $user['avatar'], // Tambahkan juga ini biar fotonya muncul
                    'isLoggedIn' => true
                ];
                // ------------------------

                session()->set($sessData);
                return redirect()->to('/admin/dashboard');
            }
        }

        return redirect()->to('/login')->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
