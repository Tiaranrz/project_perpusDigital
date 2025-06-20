<?php
namespace App\Controllers\Siswa;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        return view('siswa/profile', [
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
            'profile_image' => 'permit_empty|is_image[profile_image]|max_size[profile_image,2048]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
        ];

        $file = $this->request->getFile('profile_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!empty($user['profile_image']) && $user['profile_image'] != 'default.png' && file_exists('uploads/profiles/' . $user['profile_image'])) {
                @unlink('uploads/profiles/' . $user['profile_image']);
            }
            $newName = $file->getRandomName();
            $file->move('uploads/profiles/', $newName);
            $data['profile_image'] = $newName;
        }

        $userModel->update($userId, $data);
        // Update session
        session()->set('profile_image', $data['profile_image'] ?? $user['profile_image'] ?? 'default.png');

        return redirect()->to(base_url('siswa/profile'))->with('success', 'Profil berhasil diupdate!');
    }

    public function gantiPassword()
    {
        $userId = session()->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($userId);

        $password = $this->request->getPost('password');
        $confirm  = $this->request->getPost('confirm_password');
        if (!$password || strlen($password) < 6) {
            return redirect()->back()->withInput()->with('pass_error', 'Password minimal 6 karakter');
        }
        if ($password !== $confirm) {
            return redirect()->back()->withInput()->with('pass_error', 'Konfirmasi password tidak sama');
        }
        $userModel->update($userId, ['password' => password_hash($password, PASSWORD_DEFAULT)]);

        return redirect()->to(base_url('siswa/profile'))->with('success', 'Password berhasil diganti!');
    }
}
