<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/panel-pab/dashboard');
        }
        return view('auth/login');
    }

    public function process()
    {
        $login    = $this->request->getPost('username'); // bisa username atau email
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();

        // Cek apakah input berupa email atau username
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $user = $db->table('users')->where('email', $login)->get()->getRowArray();
        } else {
            $user = $db->table('users')->where('username', $login)->get()->getRowArray();
        }

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Check if account is active
                if (!$user['is_active']) {
                    return redirect()->to('/login')->with('error', 'Akun Anda telah dinonaktifkan. Silakan hubungi Super Admin.');
                }

                // Regenerate session ID to prevent session fixation attacks
                session()->regenerate();

                $sessData = [
                    'id'         => $user['id'],
                    'username'   => $user['username'],
                    'name'       => $user['fullname'],
                    'role'       => $user['role'],
                    'avatar'     => $user['avatar'],
                    'isLoggedIn' => true
                ];

                session()->set($sessData);

                // Catat aktivitas login
                log_activity(
                    'Login System',
                    'IP: ' . $this->request->getIPAddress(),
                    'warning'
                );

                return redirect()->to('/panel-pab/dashboard');
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
