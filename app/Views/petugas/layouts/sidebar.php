<?php 
  $uri = service('uri');
  $segment2 = $uri->getSegment(2); // dashboard, buku, peminjaman, pengembalian, anggota, laporan
  $isBookMenu = ($segment2 == 'books' || $segment2 == 'categories');
?>
<!-- Overlay for mobile (hidden by default) -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/40 z-40 xl:hidden hidden transition-opacity"></div>

<aside id="mainSidebar"
  class="w-[250px] z-50 fixed inset-y-0 left-0 flex flex-col bg-white shadow-xl rounded-2xl
    my-4 ml-4 transition-all duration-200 -translate-x-full
    xl:translate-x-0 xl:left-0 xl:my-0 xl:ml-0
    xl:top-0">
  <div class="flex items-center px-6 py-5 h-20">
    <img src="<?= base_url('images/LOGO SMK MB.png')?>" class="h-9 w-9 rounded-full shadow mr-2" alt="main_logo" />
    <span class="text-base font-bold text-fuchsia-700 tracking-tight">SMK MA'ARIF BANYURESMI</span>
  </div>
  <div class="flex-1 flex flex-col">
    <ul class="flex-1 flex flex-col gap-1 px-2">

      <!-- Dashboard Utama -->
      <li>
        <a class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold transition
          <?= $segment2 == 'dashboard' ? 'bg-fuchsia-500 text-white shadow' : 'text-slate-700 hover:bg-gray-100' ?>"
           href="<?= base_url('petugas/dashboard') ?>">
          <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 shadow">
            <i class="fas fa-tachometer-alt text-white"></i>
          </span>
          Dashboard Utama
        </a>
      </li>

      <!-- Manajemen Buku -->
      <li>
        <a class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold transition
          <?= $isBookMenu ? 'bg-fuchsia-500 text-white shadow' : 'text-slate-700 hover:bg-gray-100' ?>"
          href="<?= base_url('petugas/books') ?>">
          <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-tl from-fuchsia-700 to-pink-500 shadow">
            <i class="fas fa-book text-white"></i>
          </span>
          Manajemen Buku
        </a>
      </li>

      <!-- Peminjaman Buku -->
      <li>
        <a class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold transition
          <?= $segment2 == 'peminjaman' ? 'bg-fuchsia-500 text-white shadow' : 'text-slate-700 hover:bg-gray-100' ?>"
          href="<?= base_url('petugas/peminjaman') ?>">
          <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-tl from-blue-700 to-cyan-500 shadow">
            <i class="fas fa-hand-holding text-white"></i>
          </span>
          Peminjaman Buku
        </a>
      </li>

      <!-- Pengembalian Buku -->
      <li>
        <a class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold transition
          <?= $segment2 == 'pengembalian' ? 'bg-fuchsia-500 text-white shadow' : 'text-slate-700 hover:bg-gray-100' ?>"
          href="<?= base_url('petugas/pengembalian') ?>">
          <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-tl from-teal-500 to-green-400 shadow">
            <i class="fas fa-undo text-white"></i>
          </span>
          Pengembalian Buku
        </a>
      </li>

      <!-- Daftar Anggota -->
      <li>
        <a class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold transition
          <?= $segment2 == 'anggota' ? 'bg-fuchsia-500 text-white shadow' : 'text-slate-700 hover:bg-gray-100' ?>"
          href="<?= base_url('petugas/anggota') ?>">
          <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 shadow">
            <i class="fas fa-users text-white"></i>
          </span>
          Daftar Anggota
        </a>
      </li>

      <!-- Laporan Harian -->
      <li>
        <a class="flex items-center gap-2 px-4 py-2.5 rounded-xl font-semibold transition
          <?= $segment2 == 'laporan' ? 'bg-fuchsia-500 text-white shadow' : 'text-slate-700 hover:bg-gray-100' ?>"
          href="<?= base_url('petugas/laporan') ?>">
          <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-tl from-rose-500 to-pink-400 shadow">
            <i class="fas fa-file-alt text-white"></i>
          </span>
          Laporan Harian
        </a>
      </li>

    </ul>
  </div>
</aside>

<!-- Script Hamburger Toggle -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  const sidebar = document.getElementById('mainSidebar');
  const overlay = document.getElementById('sidebarOverlay');
  const toggleBtn = document.getElementById('sidebarToggleBtn'); // id harus sama di navbar

  // Tampilkan sidebar jika klik hamburger
  if(toggleBtn && sidebar && overlay) {
    toggleBtn.addEventListener('click', function() {
      sidebar.classList.toggle('-translate-x-full');
      overlay.classList.toggle('hidden');
      overlay.classList.toggle('flex');
    });

    // Tutup jika klik overlay
    overlay.addEventListener('click', function() {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
    });
  }
});
</script>
