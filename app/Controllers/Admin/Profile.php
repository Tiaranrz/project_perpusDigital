<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('admin/profile/index', [
            'user' => $user,
        ]);
    }

    public function update()
{
    $userId = session()->get('user_id');
    $userModel = new UserModel();
    $user = $userModel->find($userId);

    $rules = [
        'username' => 'required|min_length[3]|max_length[30]',
        'password' => 'permit_empty|min_length[6]',
        'profile_image' => 'permit_empty|is_image[profile_image]|max_size[profile_image,2048]',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $data = [
        'username' => $this->request->getPost('username'),
    ];

    $password = $this->request->getPost('password');
    if ($password) {
        $data['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    $file = $this->request->getFile('profile_image');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        if (!empty($user['profile_image']) && $user['profile_image'] != 'default.png' && file_exists('uploads/profiles/' . $user['profile_image'])) {
            unlink('uploads/profiles/' . $user['profile_image']);
        }
        $newName = $file->getRandomName();
        $file->move('uploads/profiles/', $newName);
        $data['profile_image'] = $newName;
    }

    $userModel->update($userId, $data);

    // Ambil data terbaru dari DB, update session supaya navbar ikut berubah
    $userBaru = $userModel->find($userId);
    session()->set('profile_image', $userBaru['profile_image'] ?? 'default.png');

    return redirect()->to(base_url('admin/profile'))->with('success', 'Profil berhasil diupdate!');
}
 
}
