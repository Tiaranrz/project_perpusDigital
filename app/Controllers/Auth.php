<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $userModel = new UserModel();
            $user = $userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                // ===> SIMPAN SEMUA SESSION, termasuk 'profile_image'
                session()->set([
                    'isLoggedIn'    => true,
                    'user_id'       => $user['id'],
                    'username'      => $user['username'],
                    'role'          => $user['role'],
                    'profile_image' => $user['profile_image'] ?? 'default.png'
                ]);
                var_dump($user['profile_image']); die;
                return redirect()->to(base_url('admin/dashboard'));
            } else {
                return redirect()->back()->with('error', 'Username atau password salah!');
            }
        }
        return view('auth/login');
    }

    public function loginPost()
    {
        $session = session();
        $model = new UserModel();

        $validation = \Config\Services::validation();

        // Validasi input login
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/login')
                ->withInput()
                ->with('error', 'Username dan Password wajib diisi!');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session
            $session->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'isLoggedIn' => true,
            ]);

            // Redirect sesuai role
            switch ($user['role']) {
                case 'admin':
                    return redirect()->to('/admin/dashboard')->with('success', 'Login berhasil sebagai Admin!');
                case 'petugas':
                    return redirect()->to('/petugas/dashboard')->with('success', 'Login berhasil sebagai Petugas!');
                case 'siswa':
                    return redirect()->to('/siswa/landing')->with('success', 'Login berhasil sebagai Siswa!');
                default:
                    return redirect()->to('/dashboard')->with('success', 'Login berhasil!');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Username atau password salah.');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function registerPost()
    {
        $model = new UserModel();

        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required|is_unique[users.username]', // Cek unique
            'password' => 'required|min_length[4]',
            'role'     => 'required|in_list[admin,petugas,siswa]', // Role harus di antara list
        ];

        $messages = [
            'username' => [
                'required' => 'Username wajib diisi.',
                'is_unique' => 'Username sudah digunakan.'
            ],
            'password' => [
                'required' => 'Password wajib diisi.',
                'min_length' => 'Password minimal 4 karakter.'
            ],
            'role' => [
                'required' => 'Role wajib diisi.',
                'in_list' => 'Role tidak valid.'
            ],
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->to('/register')
                ->withInput()
                ->with('error', implode(' ', $validation->getErrors()));
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role     = $this->request->getPost('role');

        $data = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => $role,
        ];

        $model->insert($data);
        return redirect()->to('/login')->with('success', 'Akun berhasil dibuat. Silakan login!');

    }

    public function dashboard()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login dulu.');
        }

        return view('dashboard'); // bisa ditentukan per-role kalau mau
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda berhasil logout.');
    }
}
