<?php

namespace App\Controllers\Master;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        // Hanya superadmin (case-insensitive biar aman)
        if (strtolower(session('level_user') ?? '') !== 'superadmin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Master User',
            'users' => $this->userModel->findAll()
        ];
        return view('master/user/index', $data);
    }

    public function store()
    {
        $rules = [
            'name_user'     => 'required|min_length[3]',
            'username_user' => 'required|min_length[4]|is_unique[tb_user.username_user]',
            'password_user' => 'required|min_length[6]',
            'level_user'    => 'required|in_list[superadmin,supervisor,admin]',
            'phone_user'    => 'permit_empty|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->userModel->save([
            'name_user'     => $this->request->getPost('name_user'),
            'username_user' => $this->request->getPost('username_user'),
            'password_user' => $this->request->getPost('password_user'), // akan di-hash otomatis di Model
            'level_user'    => $this->request->getPost('level_user'),
            'phone_user'    => $this->request->getPost('phone_user')
        ]);

        return redirect()->to('/master/user')->with('success', 'User berhasil ditambahkan');
    }

    public function update($id_user)
    {
        $rules = [
            'name_user'     => 'required',
            'username_user' => "required|is_unique[tb_user.username_user,id_user,$id_user]",
            'level_user'    => 'required|in_list[superadmin,supervisor,admin]',
            'phone_user'    => 'permit_empty|numeric'
        ];

        if ($this->request->getPost('password_user')) {
            $rules['password_user'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id_user'       => $id_user,
            'name_user'     => $this->request->getPost('name_user'),
            'username_user' => $this->request->getPost('username_user'),
            'level_user'    => $this->request->getPost('level_user'),
            'phone_user'    => $this->request->getPost('phone_user')
        ];

        if ($this->request->getPost('password_user')) {
            $data['password_user'] = $this->request->getPost('password_user');
        }

        $this->userModel->save($data);
        return redirect()->to('/master/user')->with('success', 'User berhasil diupdate');
    }

    public function delete($id_user)
    {
        if ($id_user == session('id_user')) {
            return redirect()->back()->with('error', 'Tidak bisa hapus akun sendiri!');
        }
        $this->userModel->delete($id_user);
        return redirect()->to('/master/user')->with('success', 'User berhasil dihapus');
    }
}