<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Perpustakaan Digital</title>
    <link rel="icon" type="image/png" href="<?= base_url('images/LOGO SMK MB.png') ?>" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #60A5FA; /* Tailwind blue-400 */
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
            color: #94A3B8; /* Tailwind slate-400 */
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-blue-100 to-blue-300">
    <div class="bg-white shadow-2xl rounded-2xl flex w-full max-w-4xl overflow-hidden animate-fadeIn">
        <!-- Banner Sekolah -->
        <div class="hidden md:flex flex-col justify-center items-center bg-gradient-to-br from-blue-700 to-blue-500 text-white w-1/2 p-8">
            <img src="/images/LOGO SMK MB.png" alt="Library" class="object-contain w-44 mb-6 drop-shadow-2xl">
            <h1 class="text-3xl font-bold mb-2 tracking-wide">Perpustakaan Digital</h1>
            <p class="text-lg opacity-80 mb-8 text-center">Selamat Datang di Portal<br>SMK MB</p>
            <i class="fas fa-book-reader text-5xl opacity-70"></i>
        </div>

        <!-- Form Login -->
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-bold text-center mb-2 tracking-tight">Login Akun</h2>
            <p class="text-center text-slate-500 mb-6">Masuk untuk mengakses koleksi perpustakaan</p>

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

            <form action="/login" method="post" class="space-y-5">
                <div class="relative">
                    <i class="fas fa-user input-icon"></i>
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="Username" 
                        required 
                        class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50 transition"
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
                        class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50 transition"
                        autocomplete="current-password"
                    >
                    <i class="fa-solid fa-eye show-hide" id="togglePassword" style="right: 2.5rem;"></i>
                </div>
                <button class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200 shadow-md flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>

            <div class="flex justify-between items-center mt-5 text-sm text-slate-500">
                <span>Belum punya akun?</span>
                <a href="/register" class="text-blue-600 hover:underline font-semibold flex items-center gap-1">
                    <i class="fas fa-user-plus"></i> Daftar di sini
                </a>
            </div>
        </div>
    </div>

    <!-- Animate on load -->
    <script>
        document.body.classList.add('opacity-0');
        window.addEventListener('DOMContentLoaded', () => {
            document.body.classList.remove('opacity-0');
            document.body.classList.add('transition-opacity', 'duration-500', 'opacity-100');
        });
    </script>
    <!-- Password show/hide script -->
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
</body>
</html>
