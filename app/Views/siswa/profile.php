<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya | Siswa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="icon" type="image/png" href="<?= base_url('images/LOGO SMK MB.png') ?>">
</head>
<body class="bg-gradient-to-br from-fuchsia-50 via-white to-fuchsia-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="w-full shadow bg-white py-2 px-4 md:px-10 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <img src="<?= base_url('images/LOGO SMK MB.png') ?>" class="h-8 w-8 rounded-full" alt="logo" loading="lazy">
            <span class="font-extrabold text-fuchsia-700 text-lg tracking-wide">PERPUS SMK MA'ARIF</span>
        </div>
        <div class="flex items-center gap-3">
            <!-- Notifikasi -->
            <div class="relative">
                <a href="<?= base_url('siswa/landing') ?>" class="text-fuchsia-600 text-xl relative" aria-label="Kembali">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
            <!-- Dropdown Profile -->
            <div class="relative group">
                <button id="profileDropdownBtn" class="flex items-center gap-2 text-fuchsia-600 font-bold focus:outline-none">
                    <img src="<?= base_url('uploads/profiles/' . (session('profile_image') ?? 'default.png')) ?>"
                         class="h-7 w-7 rounded-full object-cover border border-fuchsia-200 bg-white"
                         alt="Foto Profil"
                         onerror="this.onerror=null;this.src='<?= base_url('uploads/profiles/default.png') ?>';">
                    <span><?= esc(session('username')) ?></span>
                    <i class="fa fa-caret-down ml-1"></i>
                </button>
                <div id="profileDropdownMenu" class="hidden absolute right-0 top-10 min-w-[150px] bg-white rounded-xl shadow-xl ring-1 ring-black/5 py-2 z-40">
                    <a href="<?= base_url('siswa/profile') ?>" class="block px-5 py-2 text-sm text-slate-700 hover:bg-fuchsia-50 hover:text-fuchsia-600 rounded transition">Profile</a>
                    <a href="<?= base_url('siswa/riwayat') ?>" class="block px-5 py-2 text-sm text-slate-700 hover:bg-fuchsia-50 hover:text-fuchsia-600 rounded transition">Riwayat</a>
                    <a href="<?= base_url('logout') ?>" class="block px-5 py-2 text-sm font-semibold text-red-500 hover:bg-red-50 rounded transition">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Konten Profil -->
    <div class="flex-1 flex flex-col md:flex-row items-center justify-center gap-8 px-4 pb-10 mt-8">
        <!-- Card Update Profile -->
        <div class="bg-white/95 rounded-2xl shadow-2xl w-full max-w-md border border-fuchsia-100 p-8 flex flex-col items-center relative">
            <div class="absolute top-0 right-0 mt-3 mr-3">
                <span class="bg-fuchsia-100 text-fuchsia-700 px-3 py-1 rounded-full text-xs font-bold shadow"><i class="fa fa-user"></i> Siswa</span>
            </div>
            <img src="<?= base_url('uploads/profiles/' . ($user['profile_image'] ?? 'default.png')) ?>"
                class="h-24 w-24 rounded-full border-4 border-fuchsia-200 object-cover mb-3 shadow-lg ring-4 ring-fuchsia-100"
                alt="Profile">
            <div class="text-xl font-bold text-fuchsia-700 mb-1"><?= esc($user['username']) ?></div>

            <?php if(session()->getFlashdata('success')): ?>
                <div class="mb-3 p-2 bg-green-50 border border-green-200 rounded text-green-700 text-xs text-center font-semibold">
                    <i class="fa fa-check-circle mr-1"></i><?= session()->getFlashdata('success') ?>
                </div>
            <?php endif ?>
            <?php if(session()->getFlashdata('errors')): ?>
                <div class="mb-3 p-2 bg-red-50 border border-red-200 rounded text-red-700 text-xs">
                    <?php foreach(session()->getFlashdata('errors') as $e): ?>
                        <div><i class="fa fa-exclamation-circle mr-1"></i><?= $e ?></div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <form action="<?= base_url('siswa/profile/update') ?>" method="post" enctype="multipart/form-data" class="space-y-4 w-full mt-2">
                <?= csrf_field() ?>
                <div>
                    <label class="block mb-1 text-sm font-semibold text-slate-700"><i class="fa fa-user-edit text-fuchsia-400 mr-1"></i> Username</label>
                    <input type="text" name="username" value="<?= old('username', $user['username'] ?? '') ?>"
                        class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm bg-white/80" required>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-semibold text-slate-700"><i class="fa fa-image text-fuchsia-400 mr-1"></i> Foto Profil</label>
                    <input type="file" name="profile_image" accept="image/*"
                        class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm bg-white/80">
                    <div class="text-xs text-gray-400 mt-1">Ukuran maks 2MB. Kosongkan jika tidak mengubah.</div>
                </div>
                <button type="submit" class="w-full px-6 py-2 bg-fuchsia-600 text-white rounded-lg shadow font-bold hover:bg-fuchsia-700 flex items-center gap-2 justify-center transition">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
        
        <!-- Card Ganti Password -->
        <div class="bg-white/95 rounded-2xl shadow-2xl w-full max-w-md border border-fuchsia-100 p-8 flex flex-col items-center relative">
            <div class="absolute top-0 right-0 mt-3 mr-3">
                <span class="bg-fuchsia-50 text-fuchsia-600 px-3 py-1 rounded-full text-xs font-bold shadow"><i class="fa fa-key"></i> Keamanan</span>
            </div>
            <div class="text-xl font-bold text-fuchsia-700 mb-1 flex items-center gap-2"><i class="fa fa-lock"></i> Ganti Password</div>
            <div class="text-xs text-slate-400 mb-4">Ubah password demi keamanan akun Anda.</div>

            <?php if(session()->getFlashdata('pass_error')): ?>
                <div class="mb-3 p-2 bg-red-50 border border-red-200 rounded text-red-700 text-xs"><i class="fa fa-exclamation-triangle mr-1"></i><?= session()->getFlashdata('pass_error') ?></div>
            <?php endif ?>

            <form action="<?= base_url('siswa/profile/password') ?>" method="post" class="space-y-4 w-full mt-2">
                <?= csrf_field() ?>
                <div>
                    <label class="block mb-1 text-sm font-semibold text-slate-700"><i class="fa fa-key text-fuchsia-400 mr-1"></i> Password Baru</label>
                    <input type="password" name="password" placeholder="Minimal 6 karakter"
                        class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm bg-white/80">
                </div>
                <div>
                    <label class="block mb-1 text-sm font-semibold text-slate-700"><i class="fa fa-check-circle text-fuchsia-400 mr-1"></i> Konfirmasi Password</label>
                    <input type="password" name="confirm_password" placeholder="Ulangi password baru"
                        class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm bg-white/80">
                </div>
                <button type="submit" class="w-full px-6 py-2 bg-fuchsia-700 text-white rounded-lg shadow font-bold hover:bg-fuchsia-800 flex items-center gap-2 justify-center transition">
                    <i class="fa fa-key"></i> Ganti Password
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-10 bg-gradient-to-r from-fuchsia-900 to-fuchsia-600 text-white py-10 shadow-inner rounded-t-3xl">
        <div class="max-w-6xl mx-auto px-6 md:px-16 grid md:grid-cols-3 gap-8 text-center md:text-left">
            <div class="flex flex-col items-center md:items-start gap-2">
                <div class="flex items-center gap-2 mb-2">
                    <img src="<?= base_url('images/LOGO SMK MB.png') ?>" class="h-12 w-12 rounded-full shadow" alt="Logo" loading="lazy"/>
                    <span class="font-bold text-xl">Perpustakaan SMK Ma'arif Banyuresmi</span>
                </div>
                <div class="text-xs text-fuchsia-100">Kp. Babakan Wetan, RT./02/RW./03, Sukakarya, Kec. Banyuresmi, Kabupaten Garut, Jawa Barat 44191</div>
                <div class="flex gap-3 mt-3">
                    <a href="#" class="hover:text-fuchsia-100 text-xl" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="hover:text-fuchsia-100 text-xl" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-fuchsia-100 text-xl" aria-label="Whatsapp"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div>
                <div class="font-semibold mb-2 text-lg">Navigasi</div>
                <ul class="text-sm space-y-2">
                    <li><a href="<?= base_url('siswa/landing') ?>" class="hover:underline">Beranda</a></li>
                    <li><a href="<?= base_url('siswa/profile') ?>" class="hover:underline">Profil</a></li>
                    <li><a href="<?= base_url('siswa/riwayat') ?>" class="hover:underline">Riwayat Peminjaman</a></li>
                </ul>
            </div>
            <div>
                <div class="font-semibold mb-2 text-lg">Kontak</div>
                <div class="text-sm">
                    <span class="block mb-1"><i class="fa fa-envelope mr-2"></i> info@smkmb.sch.id</span>
                    <span class="block"><i class="fa fa-phone mr-2"></i> 0898-6357-767</span>
                </div>
            </div>
        </div>
        <div class="mt-8 border-t border-fuchsia-200 pt-4 text-xs text-center text-fuchsia-200">
            &copy; <?= date('Y') ?> SMK Ma'arif Banyuresmi. All rights reserved.
        </div>
    </footer>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const btn = document.getElementById('profileDropdownBtn');
        const menu = document.getElementById('profileDropdownMenu');
        btn && btn.addEventListener('click', function(e) {
            e.stopPropagation();
            menu.classList.toggle('hidden');
        });
        document.addEventListener('click', function(e) {
            if (!btn.contains(e.target)) menu.classList.add('hidden');
        });
    });
    </script>
</body>
</html>
