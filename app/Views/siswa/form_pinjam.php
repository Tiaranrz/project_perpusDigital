<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pinjam Buku | <?= esc($book['judul']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
    <link rel="icon" type="image/png" href="<?= base_url('images/LOGO SMK MB.png') ?>">
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

<!-- Navbar -->
<nav class="w-full shadow bg-white py-2 px-4 md:px-10 flex items-center justify-between sticky top-0 z-50">
    <div class="flex items-center gap-2">
        <img src="<?= base_url('images/LOGO SMK MB.png') ?>" class="h-8 w-8 rounded-full" alt="logo" loading="lazy">
        <span class="font-extrabold text-fuchsia-700 text-lg tracking-wide">PERPUS SMK MA'ARIF</span>
    </div>
    <div class="flex items-center gap-3">
        <div class="relative">
            <a href="#" class="text-fuchsia-600 text-xl relative" aria-label="Notifikasi">
                <i class="fa fa-bell"></i>
            </a>
        </div>
        <a href="#" class="flex items-center gap-2 text-fuchsia-600 font-bold hover:underline" aria-label="Profil">
            <img src="<?= base_url('uploads/profiles/' . (session('profile_image') ?? 'default.png')) ?>"
                class="h-7 w-7 rounded-full object-cover border border-fuchsia-200 bg-white"
                alt="Foto Profil"
                onerror="this.onerror=null;this.src='<?= base_url('uploads/profiles/default.png') ?>';">
            <span><?= esc(session('username')) ?></span>
        </a>
    </div>
</nav>

<!-- Form Card -->
<div class="flex-1 flex items-center justify-center py-10 px-4">
    <div class="w-full max-w-md bg-white shadow-2xl rounded-2xl p-8 border border-fuchsia-100">
        <h2 class="text-2xl font-extrabold text-fuchsia-700 mb-4 flex items-center justify-center gap-2">
            <i class="fa fa-book-open-reader"></i> Ajukan Pinjaman Buku
        </h2>
        <div class="flex flex-col items-center mb-6">
            <!-- Cover Buku -->
            <?php if($book['cover']): ?>
                <img src="<?= base_url('uploads/covers/'.$book['cover']) ?>" alt="cover" loading="lazy"
                    class="h-28 w-20 object-cover rounded shadow mb-2 border border-fuchsia-200">
            <?php else: ?>
                <div class="h-28 w-20 bg-gray-200 rounded flex items-center justify-center mb-2 text-gray-400">
                    <i class="fa fa-book fa-2x"></i>
                </div>
            <?php endif ?>
            <div class="font-bold text-lg text-fuchsia-800 mb-0.5"><?= esc($book['judul']) ?></div>
            <div class="text-sm text-slate-500">Penulis: <b><?= esc($book['penulis']) ?></b></div>
            <div class="text-xs text-blue-500 italic mb-2"><?= esc($book['kategori_nama'] ?? '-') ?></div>
        </div>

        <!-- Form Ajukan Pinjam -->
        <form action="<?= base_url('siswa/landing/pinjam/'.$book['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label class="text-sm text-gray-700 font-semibold block mb-1"><i class="fa fa-calendar-alt text-fuchsia-400 mr-1"></i> Tanggal Pinjam</label>
                <input type="text" readonly value="<?= date('d-m-Y') ?>" class="w-full px-4 py-2 border border-fuchsia-200 rounded bg-gray-100 text-sm text-slate-700 font-bold text-center focus:outline-none">
            </div>
            <button type="submit"
                class="mt-6 w-full px-6 py-2 rounded-lg bg-fuchsia-600 text-white font-semibold shadow hover:bg-fuchsia-700 transition flex items-center justify-center gap-2 text-base focus:outline-none focus:ring-2 focus:ring-fuchsia-400">
                <i class="fa fa-check-circle"></i> Ajukan Pinjam Buku
            </button>
            <a href="<?= base_url('siswa/landing') ?>" class="block mt-4 text-gray-400 hover:text-fuchsia-500 text-sm font-semibold transition"><i class="fa fa-arrow-left"></i> Kembali ke Katalog</a>
        </form>
        <div class="text-xs text-gray-400 mt-6">* Setelah mengajukan pinjam, tunggu persetujuan petugas.</div>
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

</body>
</html>
