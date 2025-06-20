<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function index($role = 'admin')
    {
        $userModel = new UserModel();

        $search = $this->request->getGet('q');
        $query = $userModel->where('role', $role);
        if ($search) {
            $query->groupStart()
                ->like('username', $search)
                ->groupEnd();
        }
        $users = $query->orderBy('id', 'DESC')->findAll();

        $roles = [
            'admin'   => 'Admin',
            'petugas' => 'Petugas',
            'siswa'   => 'Siswa'
        ];

        // Breadcrumb dinamis
        $breadcrumb = [
            ['label' => 'Dashboard', 'url' => base_url('admin/dashboard')],
            ['label' => 'Manajemen User', 'url' => base_url('admin/users/admin')],
            ['label' => $roles[$role] ?? ucfirst($role), 'url' => '']
        ];

        $data = [
            'title'      => 'Manajemen User',
            'role'       => $role,
            'role_label' => $roles[$role] ?? ucfirst($role),
            'users'      => $users,
            'breadcrumb' => $breadcrumb,
            'search'     => $search,
        ];

        return view('admin/users/index', $data);
    }

    public function add($role = 'admin')
    {
        $breadcrumb = [
            ['label' => 'Dashboard', 'url' => base_url('admin/dashboard')],
            ['label' => 'Manajemen User', 'url' => base_url('admin/users/'.$role)],
            ['label' => 'Tambah '.ucfirst($role), 'url' => '']
        ];
        return view('admin/users/form', [
            'title' => 'Tambah User '.ucfirst($role),
            'role' => $role,
            'breadcrumb' => $breadcrumb,
            'user' => null,
            'form_action' => base_url('admin/users/'.$role.'/save'),
        ]);
    }

    public function save($role = 'admin')
    {
        $validation = \Config\Services::validation();
        $rules = [
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[4]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $userModel = new UserModel();
        $userModel->save([
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => $role,
        ]);
        return redirect()->to(base_url('admin/users/'.$role))->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($role = 'admin', $id = null)
    {
        $userModel = new UserModel();
        $user = $userModel->where('role', $role)->find($id);
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $breadcrumb = [
            ['label' => 'Dashboard', 'url' => base_url('admin/dashboard')],
            ['label' => 'Manajemen User', 'url' => base_url('admin/users/'.$role)],
            ['label' => 'Edit '.ucfirst($role), 'url' => '']
        ];
        return view('admin/users/form', [
            'title' => 'Edit User '.ucfirst($role),
            'role' => $role,
            'breadcrumb' => $breadcrumb,
            'user' => $user,
            'form_action' => base_url('admin/users/'.$role.'/update/'.$id),
        ]);
    }

    public function update($role = 'admin', $id = null)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $validation = \Config\Services::validation();
        $rules = [
            'username' => 'required|is_unique[users.username,id,'.$id.']',
        ];
        $password = $this->request->getPost('password');
        if ($password) {
            $rules['password'] = 'min_length[4]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $updateData = [
            'username' => $this->request->getPost('username'),
        ];
        if ($password) {
            $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }
        $userModel->update($id, $updateData);
        return redirect()->to(base_url('admin/users/'.$role))->with('success', 'User berhasil diupdate!');
    }

    public function delete($role = 'admin', $id = null)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to(base_url('admin/users/'.$role))->with('success', 'User berhasil dihapus!');
    }

    public function password($role = 'admin', $id = null)
{
    $userModel = new UserModel();
    $user = $userModel->find($id);
    if (!$user) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    $breadcrumb = [
        ['label' => 'Dashboard', 'url' => base_url('admin/dashboard')],
        ['label' => 'Manajemen User', 'url' => base_url('admin/users/'.$role)],
        ['label' => 'Ganti Password', 'url' => '']
    ];
    return view('admin/users/password', [
        'title' => 'Ganti Password',
        'role' => $role,
        'user' => $user,
        'breadcrumb' => $breadcrumb,
        'form_action' => base_url('admin/users/'.$role.'/password/'.$id),
    ]);
}

public function password_save($role = 'admin', $id = null)
{
    $userModel = new UserModel();
    $user = $userModel->find($id);
    if (!$user) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
    $password = $this->request->getPost('password');
    $confirm  = $this->request->getPost('confirm_password');
    if (!$password || strlen($password) < 4) {
        return redirect()->back()->withInput()->with('errors', ['Password minimal 4 karakter']);
    }
    if ($password !== $confirm) {
        return redirect()->back()->withInput()->with('errors', ['Konfirmasi password tidak sama']);
    }
    $userModel->update($id, ['password' => password_hash($password, PASSWORD_BCRYPT)]);
    return redirect()->to(base_url('admin/users/'.$role))->with('success', 'Password berhasil diganti!');
}

}
