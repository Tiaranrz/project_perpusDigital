<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($book['judul']) ?> | Detail Buku</title>
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


<!-- Detail Buku -->
<div class="max-w-3xl mx-auto mt-12 bg-white rounded-2xl shadow-xl p-8 flex flex-col md:flex-row gap-8 border border-fuchsia-100">
    <div class="flex-shrink-0 flex flex-col items-center w-full md:w-auto">
        <?php if($book['cover']): ?>
            <img src="<?= base_url('uploads/covers/'.$book['cover']) ?>" class="h-64 w-44 rounded-xl shadow-lg object-cover border border-fuchsia-100" alt="cover">
        <?php else: ?>
            <div class="h-64 w-44 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400 border border-fuchsia-100">
                <i class="fa fa-book fa-3x"></i>
            </div>
        <?php endif ?>
        <!-- Stok badge -->
        <span class="mt-4 px-4 py-1 rounded-full font-bold text-sm 
            <?= $book['sisa'] > 0 ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-500' ?>">
            <?= $book['sisa'] > 0 ? $book['sisa'].' Tersedia' : 'Tidak Tersedia' ?>
        </span>
    </div>
    <div class="flex-1 flex flex-col gap-3 justify-center">
        <div>
            <span class="inline-block px-3 py-1 rounded-full bg-fuchsia-100 text-fuchsia-700 text-xs font-bold mb-2">
                <?= esc($book['kategori_nama']) ?>
            </span>
        </div>
        <h1 class="text-3xl font-extrabold text-fuchsia-700 mb-2"><?= esc($book['judul']) ?></h1>
        <div class="text-gray-500 text-sm mb-2">Penulis: <span class="font-semibold text-slate-700"><?= esc($book['penulis']) ?></span></div>
        <div class="text-gray-500 text-sm mb-2">Penerbit: <b><?= esc($book['penerbit']) ?></b> &middot; Tahun: <b><?= esc($book['tahun_terbit']) ?></b></div>
        <div class="text-gray-500 text-sm mb-2">ISBN: <span class="font-mono"><?= esc($book['isbn']) ?></span></div>
        <div class="mt-4 flex gap-3 flex-wrap">
            <a href="<?= base_url('siswa/landing') ?>" class="px-5 py-2 bg-gray-100 text-slate-600 rounded-lg shadow hover:bg-gray-200 transition font-semibold flex items-center gap-2">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
            <?php if($book['sisa'] > 0): ?>
            <a href="<?= base_url('siswa/landing/formPinjam/'.$book['id']) ?>" class="px-6 py-2 bg-fuchsia-600 text-white font-bold rounded-lg shadow hover:bg-fuchsia-700 transition flex items-center gap-2">
                <i class="fa fa-book-open-reader"></i> Pinjam Buku
            </a>
            <?php else: ?>
            <button disabled class="px-6 py-2 bg-gray-300 text-gray-400 font-bold rounded-lg shadow flex items-center gap-2">
                <i class="fa fa-book-open-reader"></i> Pinjam Buku
            </button>
            <?php endif ?>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="mt-16 bg-gradient-to-r from-fuchsia-900 to-fuchsia-600 text-white py-10 shadow-inner rounded-t-3xl">
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
