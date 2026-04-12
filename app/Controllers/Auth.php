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
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $db = \Config\Database::connect();
        $user = $db->table('users')->where('username', $username)->get()->getRowArray();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                $sessData = [
                    'id'         => $user['id'],
                    'username'   => $user['username'],
                    'name'       => $user['fullname'],
                    'role'       => $user['role'],
                    'avatar'     => $user['avatar'],
                    'isLoggedIn' => true
                ];

                session()->set($sessData);
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
