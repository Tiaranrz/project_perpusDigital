    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Perpustakaan SMK MB | Katalog Buku</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Tailwind CSS CDN -->
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>
        <!-- LottiePlayer -->
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <link rel="icon" type="image/png" href="<?= base_url('images/LOGO SMK MB.png') ?>">
    </head>
    <body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="w-full shadow bg-white py-2 px-4 md:px-10 flex items-center justify-between sticky top-0 z-50">
        <div class="flex items-center gap-2">
            <img src="<?= base_url('images/LOGO SMK MB.png') ?>" class="h-8 w-8 rounded-full" alt="logo" loading="lazy">
            <span class="font-extrabold text-fuchsia-700 text-lg tracking-wide">PERPUS SMK MA'ARIF</span>
        </div>
        <form action="" method="get" class="flex items-center flex-1 max-w-md mx-4 md:mx-10">
            <input type="text" name="q" value="<?= esc($search) ?>" aria-label="Cari buku atau penulis"
                placeholder="Cari buku/penulis..." 
                class="flex-1 rounded-l px-4 py-2 border border-fuchsia-200 focus:outline-none focus:ring-1 focus:ring-fuchsia-400 bg-white text-gray-700 text-sm shadow-sm"
            >
            <button class="px-3 py-2 bg-fuchsia-500 rounded-r text-white hover:bg-fuchsia-600" aria-label="Cari">
                <i class="fa fa-search"></i>
            </button>
        </form>
        <div class="flex items-center gap-3">
            <div class="relative">
    <button id="notifBtn" class="text-fuchsia-600 text-xl relative focus:outline-none" aria-label="Notifikasi">
        <i class="fa fa-bell"></i>
        <?php if($notifikasiBaru): ?>
        <span id="notifCount" class="absolute -top-1 -right-1 bg-pink-500 text-white rounded-full text-[10px] px-1.5 py-0.5 font-bold animate-pulse"><?= $notifikasiBaru ?></span>
        <?php endif ?>
    </button>
    <!-- Dropdown -->
    <div id="notifDropdown"
        class="hidden absolute right-0 z-50 mt-2 w-[340px] bg-white border border-fuchsia-200 rounded-xl shadow-lg max-h-[380px] overflow-y-auto p-3 transition-all duration-200">
        <div class="font-bold text-fuchsia-700 mb-2 flex items-center gap-2 text-base"><i class="fa fa-bell"></i> Notifikasi</div>
        <div id="notifContent" class="space-y-3 min-h-[60px]">
            <div class="text-center text-slate-400 py-5"><i class="fa fa-spinner fa-spin"></i> Loading...</div>
        </div>
        <button id="closeNotif" class="w-full mt-2 py-1.5 rounded-lg text-xs font-semibold text-fuchsia-500 bg-fuchsia-50 hover:bg-fuchsia-100 transition"><i class="fa fa-times mr-1"></i> Tutup</button>
    </div>
</div>

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

    <!-- Hero Section -->
<section class="w-full py-14 px-4 md:px-16 bg-gradient-to-r from-fuchsia-600 via-pink-400 to-fuchsia-300 flex flex-col md:flex-row items-center justify-between shadow-lg rounded-b-3xl">
    <div class="flex-1 md:pr-10 mb-8 md:mb-0">
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow-lg leading-tight">
            Selamat Datang di<br>
            <span class="text-fuchsia-200">Perpustakaan Digital</span> SMK Ma'arif Banyuresmi!
        </h1>
        <p class="text-white/90 text-lg font-medium mb-6 drop-shadow">
            Temukan, pinjam, dan baca ribuan koleksi buku favoritmu.<br>
            Praktis, mudah, <span class="italic">dan menyenangkan!</span>
        </p>
        <a href="#katalog-buku" class="inline-block bg-white text-fuchsia-600 px-8 py-3 rounded-full font-bold shadow-lg hover:bg-fuchsia-50 transition text-lg focus:outline-none focus:ring-2 focus:ring-fuchsia-500">
            <i class="fa fa-book-reader mr-2"></i>Jelajahi Katalog
        </a>
    </div>
    <div class="flex-1 flex justify-center">
        <lottie-player
            src="https://assets4.lottiefiles.com/packages/lf20_HpFqiS.json"
            background="transparent"
            speed="1"
            style="width: 350px; height: 350px;"
            loop autoplay
            aria-label="Ilustrasi animasi membaca buku"
        ></lottie-player>
    </div>
</section>


    <!-- Filter Kategori -->
<div class="w-full overflow-x-auto flex gap-2 py-4 px-4 md:px-16 scrollbar-hide">
    <a href="<?= base_url('siswa/landing') ?>"
        class="flex-shrink-0 px-5 py-2 rounded-full border border-fuchsia-300 font-semibold text-fuchsia-700 bg-white shadow-sm hover:bg-fuchsia-100 transition <?= !$kategori ? 'ring-2 ring-fuchsia-400 bg-fuchsia-100 text-fuchsia-800' : '' ?>">
        Semua Kategori
    </a>
    <?php foreach($categories as $cat): ?>
        <a href="<?= base_url('siswa/landing?kategori='.$cat['id']) ?>"
           class="flex-shrink-0 px-5 py-2 rounded-full border border-fuchsia-300 font-semibold text-fuchsia-700 bg-white shadow-sm hover:bg-fuchsia-100 transition <?= $kategori == $cat['id'] ? 'ring-2 ring-fuchsia-400 bg-fuchsia-100 text-fuchsia-800' : '' ?>">
            <?= esc($cat['nama']) ?>
        </a>
    <?php endforeach ?>
</div>


    <!-- Katalog Buku -->
    <section id="katalog-buku" class="w-full max-w-7xl mx-auto mt-6 flex-1 px-4 md:px-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 mb-16">
        <?php foreach($books as $book): ?>
        <div class="bg-white rounded-2xl shadow-lg p-4 flex flex-col items-center group hover:scale-105 transition-all duration-200 relative">
            <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-xs font-bold 
                <?= $book['sisa'] > 0 ? 'bg-green-100 text-green-600' : 'bg-gray-200 text-gray-500' ?>">
                <?= $book['sisa'] > 0 ? 'Bisa Dipinjam' : 'Tidak Tersedia' ?>
            </span>
            <!-- Cover -->
            <?php if($book['cover']): ?>
                <img src="<?= base_url('uploads/covers/'.$book['cover']) ?>" alt="cover" loading="lazy"
                    class="h-44 w-32 object-cover rounded-xl shadow mb-3 mt-2 group-hover:shadow-xl border border-fuchsia-100">
            <?php else: ?>
                <div class="h-44 w-32 bg-gray-200 rounded-xl flex items-center justify-center mb-3 mt-2 text-gray-400" aria-label="Buku tanpa cover">
                    <i class="fa fa-book fa-2x"></i>
                </div>
            <?php endif ?>
            <div class="text-center flex-1 w-full">
                <div class="font-bold text-fuchsia-800 text-base mb-0.5"><?= esc($book['judul']) ?></div>
                <div class="text-xs text-slate-400 mb-1">by <?= esc($book['penulis']) ?></div>
                <div class="text-xs text-blue-500 italic mb-3"><?= esc($book['kategori_nama']) ?></div>
            </div>
            <a 
                href="<?= base_url('siswa/landing/formPinjam/'.$book['id']) ?>"
                class="mt-auto px-5 py-2 rounded-lg bg-fuchsia-600 text-white font-semibold shadow hover:bg-fuchsia-700 flex items-center gap-2 transition w-full disabled:bg-gray-300 disabled:text-gray-400 disabled:cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-fuchsia-400 <?= $book['sisa'] > 0 ? '' : 'pointer-events-none opacity-60' ?>"
                aria-label="Pinjam Buku: <?= esc($book['judul']) ?>">
                <i class="fa fa-book-open-reader"></i> Pinjam
            </a>
            <a 
    href="<?= base_url('siswa/landing/detail/'.$book['id']) ?>"
    class="mt-2 px-5 py-2 rounded-lg bg-white border border-fuchsia-300 text-fuchsia-600 font-semibold shadow hover:bg-fuchsia-50 flex items-center gap-2 transition w-full focus:outline-none focus:ring-2 focus:ring-fuchsia-400"
    aria-label="Lihat Detail Buku: <?= esc($book['judul']) ?>">
    <i class="fa fa-info-circle"></i> Detail Buku
</a>
        </div>
        <?php endforeach ?>
        <?php if(count($books) == 0): ?>
            <div class="col-span-full text-center text-slate-400 text-lg">Buku tidak ditemukan.</div>
        <?php endif ?>
    </div>
</section>


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

<script>
document.addEventListener("DOMContentLoaded", function() {
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    const notifContent = document.getElementById('notifContent');
    const closeNotif = document.getElementById('closeNotif');

    notifBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    notifDropdown.classList.toggle('hidden');
    notifContent.innerHTML = '<div class="text-center text-slate-400 py-5"><i class="fa fa-spinner fa-spin"></i> Loading...</div>';
    fetch('<?= base_url('siswa/notifikasi/ajax') ?>')
    .then(res => res.json())
    .then(res => {
        if(res.status === 'ok') {
            if(!res.notif || res.notif.length === 0) {
                notifContent.innerHTML = '<div class="text-center text-slate-400 py-5"><i class="fa fa-bell-slash"></i> Belum ada notifikasi.</div>';
                return;
            }
            let html = '';
            res.notif.forEach(n => {
                let badge = '';
                if(n.status === 'jatuh tempo') badge = `<span class="ml-2 px-2 py-0.5 rounded-full bg-rose-100 text-rose-600 text-xs font-bold">Jatuh Tempo</span>`;
                else if(n.status === 'ditolak') badge = `<span class="ml-2 px-2 py-0.5 rounded-full bg-red-100 text-red-500 text-xs font-bold">Ditolak</span>`;
                else if(n.status === 'dikembalikan') badge = `<span class="ml-2 px-2 py-0.5 rounded-full bg-green-100 text-green-600 text-xs font-bold">Dikembalikan</span>`;

                html += `<div class="flex items-start gap-3 border-b pb-2 last:border-0 mb-2 last:mb-0">
                    ${n.cover ? `<img src="<?= base_url('uploads/covers/') ?>${n.cover}" class="w-10 h-14 object-cover rounded shadow" alt="cover">`
                    : `<div class="w-10 h-14 bg-gray-200 rounded flex items-center justify-center text-gray-400"><i class="fa fa-book"></i></div>`}
                    <div>
                        <div class="font-semibold text-fuchsia-800 text-sm mb-0.5">${n.judul}${badge}</div>
                        <div class="text-xs text-slate-400 mb-1">Tgl. Pinjam: <span class="font-semibold">${n.tanggal_pinjam}</span></div>
                        <div class="text-xs mb-1">
                            ${n.status === 'jatuh tempo' ? `<span class="text-rose-600 font-bold">Segera kembalikan buku ini!</span>` :
                            (n.status === 'ditolak' ? `<span class="text-red-500">Permintaan pinjaman ditolak petugas.</span>` :
                            (n.status === 'dikembalikan' ? `<span class="text-green-600">Sudah dikembalikan.</span>` :
                            `<span class="text-fuchsia-500">Status: <b>${n.status}</b></span>`))}
                        </div>
                    </div>
                </div>`;
            });
            notifContent.innerHTML = html;
        } else {
            notifContent.innerHTML = '<div class="text-center text-rose-400 py-5"><i class="fa fa-exclamation-triangle"></i> Gagal mengambil notifikasi.</div>';
        }
    })
    .catch(err => {
        notifContent.innerHTML = '<div class="text-center text-rose-400 py-5"><i class="fa fa-exclamation-triangle"></i> Tidak bisa terhubung ke server.</div>';
    });
});

    // Close dropdown if click outside
    document.addEventListener('click', function(e){
        if(!notifDropdown.contains(e.target) && !notifBtn.contains(e.target)){
            notifDropdown.classList.add('hidden');
        }
    });
    closeNotif.addEventListener('click', function(){
        notifDropdown.classList.add('hidden');
    });
});
</script>


    </body>
    </html>
