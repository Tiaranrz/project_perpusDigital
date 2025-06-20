<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Perpustakaan Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="<?= base_url('images/LOGO SMK MB.png') ?>" />
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .bg-img {
            background: url('/images/Halaman SMK-MB.jpeg') center center/cover no-repeat;
            position: fixed;
            top: 0; left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 0;
            filter: blur(7px) brightness(0.8);
        }
        .glass-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(9px) saturate(120%);
            box-shadow: 0 8px 32px 0 rgba(31,38,135,0.18);
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #60A5FA;
        }
        .input-field {
            padding-left: 2.5rem !important;
        }
        .show-hide {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94A3B8;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <!-- Background Gambar Blur -->
    <div class="bg-img"></div>

    <!-- Register Card -->
    <div class="relative z-10 w-full max-w-4xl mx-auto flex items-center justify-center min-h-[70vh]">
        <div class="glass-card rounded-3xl shadow-2xl flex w-full overflow-hidden">
            <!-- Ilustrasi Abang -->
            <div class="hidden md:flex md:w-1/2 items-center justify-center bg-transparent">
                <img 
                    src="https://assets9.lottiefiles.com/private_files/lf30_v9rcxh4p.json"
                    alt="Abang Librarian" 
                    class="object-contain w-64"
                    id="abang-illustration"
                >
            </div>

            <!-- Form Register -->
            <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-center mb-2 tracking-tight">Daftar Akun</h2>
                <p class="text-center text-slate-500 mb-6">Bergabung dan dapatkan akses ke ribuan koleksi digital!</p>

                <!-- ALERT FLASHDATA -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 flex items-center gap-2 border border-red-300">
                        <i class="fas fa-exclamation-circle"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4 flex items-center gap-2 border border-green-300">
                        <i class="fas fa-check-circle"></i>
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <form action="/register" method="post" class="space-y-5">
                    <div class="relative">
                        <i class="fas fa-user input-icon"></i>
                        <input 
                            type="text" 
                            name="username" 
                            placeholder="Username" 
                            required 
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 transition"
                            autocomplete="username"
                        >
                    </div>
                    <div class="relative">
                        <i class="fas fa-lock input-icon"></i>
                        <input 
                            type="password" 
                            name="password" 
                            id="passwordInput"
                            placeholder="Password" 
                            required 
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 transition"
                            autocomplete="new-password"
                        >
                        <i class="fa-solid fa-eye show-hide" id="togglePassword" style="right: 2.5rem;"></i>
                    </div>
                    <div class="relative">
                        <i class="fas fa-user-shield input-icon"></i>
                        <select 
                            name="role" 
                            required
                            class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 bg-gray-50 transition"
                        >
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                            <option value="siswa">Siswa</option>
                        </select>
                    </div>
                    <button class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition duration-200 shadow-md flex items-center justify-center gap-2">
                        <i class="fas fa-user-plus"></i> Daftar
                    </button>
                </form>

                <div class="flex justify-between items-center mt-5 text-sm text-slate-500">
                    <span>Sudah punya akun?</span>
                    <a href="/login" class="text-blue-600 hover:underline font-semibold flex items-center gap-1">
                        <i class="fas fa-sign-in-alt"></i> Login di sini
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Fade in animation -->
    <script>
        document.body.classList.add('opacity-0');
        window.addEventListener('DOMContentLoaded', () => {
            document.body.classList.remove('opacity-0');
            document.body.classList.add('transition-opacity', 'duration-500', 'opacity-100');
        });
    </script>
    <!-- Show/hide password -->
    <script>
        const toggle = document.getElementById('togglePassword');
        const input = document.getElementById('passwordInput');
        let show = false;

        toggle.addEventListener('click', function () {
            show = !show;
            input.type = show ? 'text' : 'password';
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <!-- Load ilustrasi abang Lottie -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script>
        // Ganti gambar di <img> dengan lottie jika ingin animasi
        document.getElementById('abang-illustration').outerHTML = `
            <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_jcikwtux.json"  background="transparent"  speed="1"  style="width: 350px; height: 350px;"  loop  autoplay></lottie-player>
        `;
    </script>
</body>
</html>
