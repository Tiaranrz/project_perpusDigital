<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman Buku</title>
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

<!-- Card Riwayat -->
<div class="flex-1 w-full max-w-4xl mx-auto my-12 bg-white rounded-2xl shadow-xl p-8 border border-fuchsia-100">
    <h2 class="text-2xl font-extrabold text-fuchsia-700 mb-4 flex items-center gap-2">
        <i class="fa fa-clock-rotate-left"></i> Riwayat Peminjaman
    </h2>
    <div class="overflow-x-auto rounded-xl">
        <table class="min-w-full text-sm border rounded-xl overflow-hidden">
            <thead class="bg-fuchsia-50">
                <tr>
                    <th class="px-3 py-2 font-bold text-fuchsia-700">Cover</th>
                    <th class="px-3 py-2 font-bold text-fuchsia-700">Judul Buku</th>
                    <th class="px-3 py-2 font-bold text-fuchsia-700">Tgl Pinjam</th>
                    <th class="px-3 py-2 font-bold text-fuchsia-700">Tgl Kembali</th>
                    <th class="px-3 py-2 font-bold text-fuchsia-700">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($riwayat as $r): ?>
                <tr class="odd:bg-white even:bg-fuchsia-50 group hover:bg-fuchsia-100 transition">
                    <td class="py-2">
                        <?php if($r['cover']): ?>
                            <img src="<?= base_url('uploads/covers/'.$r['cover']) ?>" class="h-12 w-8 object-cover rounded shadow border border-fuchsia-100">
                        <?php else: ?>
                            <div class="h-12 w-8 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                                <i class="fa fa-book"></i>
                            </div>
                        <?php endif ?>
                    </td>
                    <td class="px-2 py-2 font-medium"><?= esc($r['judul']) ?></td>
                    <td class="px-2 py-2"><?= date('d-m-Y', strtotime($r['tanggal_pinjam'])) ?></td>
                    <td class="px-2 py-2"><?= $r['tanggal_kembali'] ? date('d-m-Y', strtotime($r['tanggal_kembali'])) : '-' ?></td>
                    <td class="px-2 py-2">
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            <?= $r['status']=='approved' ? 'bg-green-100 text-green-700' : 
                                  ($r['status']=='pending' ? 'bg-yellow-100 text-yellow-700' : 
                                  ($r['status']=='rejected' ? 'bg-red-100 text-red-700' : 
                                  ($r['status']=='dipinjam' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600'))) ?>">
                            <?= ucfirst($r['status']) ?>
                        </span>
                    </td>
                </tr>
                <?php endforeach ?>
                <?php if(count($riwayat)==0): ?>
                <tr><td colspan="5" class="text-center text-slate-400 py-5">Belum ada riwayat peminjaman.</td></tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
    <a href="<?= base_url('siswa/landing') ?>" class="mt-8 inline-block text-fuchsia-600 font-bold hover:underline text-base">
        <i class="fa fa-arrow-left"></i> Kembali ke Katalog
    </a>
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
