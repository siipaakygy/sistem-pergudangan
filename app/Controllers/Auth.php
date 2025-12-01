<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->has('id_user')) {
            return redirect()->to('/');
        }
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $rules = [
            'username_user' => 'required',
            'password_user' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Username & password wajib diisi');
        }

        $userModel = new UserModel();
        $user = $userModel->where('username_user', $this->request->getPost('username_user'))->first();

        if (!$user || !password_verify($this->request->getPost('password_user'), $user['password_user'])) {
            return redirect()->back()->with('error', 'Username atau password salah!');
        }

        session()->set([
            'id_user'       => $user['id_user'],
            'name_user'     => $user['name_user'],
            'level_user'    => $user['level_user'],
            'isLoggedIn'    => true
        ]);

        return redirect()->to('/')->with('success', 'Selamat datang, ' . $user['name_user']);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logout berhasil');
    }
}