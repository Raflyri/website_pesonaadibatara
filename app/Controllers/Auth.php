<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel; // Pastikan nanti buat UserModel, atau pakai Builder sementara

class Auth extends BaseController
{
    public function index()
    {
        // Kalau sudah login, lempar langsung ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function process()
    {
        // 1. Ambil input
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // 2. Cek User di Database
        // Catatan: Sebaiknya pakai UserModel, tapi pakai Query Builder dulu biar cepat
        $db = \Config\Database::connect();
        $user = $db->table('users')->where('username', $username)->get()->getRowArray();

        // 3. Verifikasi
        if ($user) {
            // Cek Password Hash
            if (password_verify($password, $user['password'])) {
                // Set Session
                $sessData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'fullname' => $user['fullname'],
                    'role' => $user['role'],
                    'isLoggedIn' => true
                ];
                session()->set($sessData);
                return redirect()->to('/dashboard');
            }
        }

        // Kalau gagal
        return redirect()->to('/login')->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}