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
            // PENTING: Pastikan password di database sudah di-hash pakai password_hash()
            // Kalau kamu manual insert 'admin123' di database tanpa hash,
            // kode password_verify ini akan GAGAL.
            
            if (password_verify($password, $user['password'])) {
                $sessData = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'fullname' => $user['fullname'], // Sesuaikan dengan kolom DB (name/fullname?)
                    'isLoggedIn' => true
                ];
                session()->set($sessData);
                
                // Redirect ke area Admin yang terlindungi
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