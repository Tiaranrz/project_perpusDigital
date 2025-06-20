<?php
$session = session();
$isLoggedIn = $session->get('isLoggedIn');
$username = $session->get('username');
$role = $session->get('role');
$profile_image = $session->get('profile_image') ?: 'default.png';
$uri = service('uri');
$segment2 = $uri->getSegment(2) ?? '';
$breadcrumb = ucfirst($segment2 ?: 'Dashboard');

// Route search otomatis (PETUGAS)
$searchAction = '';
switch ($segment2) {
    case 'buku':
        $searchAction = base_url('petugas/buku');
        break;
    case 'peminjaman':
        $searchAction = base_url('petugas/peminjaman');
        break;
    case 'pengembalian':
        $searchAction = base_url('petugas/pengembalian');
        break;
    case 'anggota':
        $searchAction = base_url('petugas/anggota');
        break;
    case 'laporan':
        $searchAction = base_url('petugas/laporan');
        break;
    default:
        $searchAction = '#';
}
?>
<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
  <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
    <nav>
      <!-- breadcrumb -->
      <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
        <li class="text-sm leading-normal">
          <a class="opacity-50 text-slate-700" href="<?= base_url('petugas/dashboard') ?>">Dashboard</a>
        </li>
        <?php if ($segment2): ?>
        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">
          <?= esc($breadcrumb) ?>
        </li>
        <?php endif ?>
      </ol>
      <h6 class="mb-0 font-bold capitalize"><?= esc($breadcrumb) ?></h6>
    </nav>

    <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
      <div class="flex items-center md:ml-auto md:pr-4">
        <!-- SEARCH FORM (hanya di desktop) -->
        <form action="<?= $searchAction ?>" method="get"
          class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft hidden md:flex">
          <span class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
            <i class="fas fa-search"></i>
          </span>
          <input name="q" type="text"
            class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
            placeholder="Cari di halaman ini..." value="<?= esc($_GET['q'] ?? '') ?>" />
        </form>
      </div>

      <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">

        <!-- User Info Dinamis -->
        <li class="flex items-center">
          <?php if ($isLoggedIn): ?>
            <span class="block px-2 py-2 text-sm font-semibold text-slate-700 flex items-center">
              <!-- Avatar Kecil -->
              <img src="<?= base_url('uploads/profiles/' . ($profile_image ?? 'default.png')) ?>"
                   alt="Foto Profil"
                   class="w-7 h-7 rounded-full object-cover mr-2 border border-fuchsia-200 bg-white"
                   onerror="this.onerror=null;this.src='<?= base_url('uploads/profiles/default.png') ?>';">
              <?= esc($username) ?> <span class="text-xs text-slate-400 ml-1">(<?= esc(ucfirst($role)) ?>)</span>
            </span>
          <?php else: ?>
            <a href="<?= base_url('login') ?>" class="block px-2 py-2 text-sm font-semibold transition-all ease-nav-brand text-slate-500">
              <i class="fa fa-user mr-1"></i>
              Sign In
            </a>
          <?php endif; ?>
        </li>

        <!-- Notifikasi -->
        <li class="relative flex items-center pr-2">
          <button type="button" class="block p-0 text-sm transition-all ease-nav-brand text-slate-500 focus:outline-none"
                  id="notifDropdownBtn">
            <i class="cursor-pointer fa fa-bell"></i>
          </button>
          <ul id="notifDropdownMenu"
              class="hidden absolute right-0 top-10 z-50 min-w-44 rounded-lg bg-white shadow-lg px-2 py-4 text-left text-slate-500">
            <li class="relative mb-2">
              <a class="py-2 block w-full whitespace-nowrap rounded-lg hover:bg-gray-200 hover:text-slate-700 px-4" href="javascript:;">
                <div class="flex py-1">
                  <div class="my-auto">
                    <img src="<?= base_url('assets/img/team-2.jpg') ?>" class="inline-flex items-center justify-center mr-4 text-sm text-white h-9 w-9 max-w-none rounded-xl" />
                  </div>
                  <div class="flex flex-col justify-center">
                    <h6 class="mb-1 text-sm font-normal leading-normal"><span class="font-semibold">New message</span> dari Laur</h6>
                    <p class="mb-0 text-xs leading-tight text-slate-400">
                      <i class="mr-1 fa fa-clock"></i>
                      13 menit lalu
                    </p>
                  </div>
                </div>
              </a>
            </li>
          </ul>
        </li>

        <!-- Hamburger Menu (mobile) -->
        <li class="flex items-center xl:hidden ">
          <button id="sidebarToggleBtn" type="button" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-fuchsia-100 focus:outline-none transition" title="Menu">
            <i class="fa fa-bars text-xl text-slate-500"></i>
          </button>
        </li>

        <!-- Pengaturan (Settings) Dropdown -->
        <?php if ($isLoggedIn): ?>
        <li class="relative flex items-center pr-2" id="settingDropdown">
          <button
            id="settingDropdownBtn"
            type="button"
            class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-fuchsia-100 focus:outline-none transition"
            aria-haspopup="true"
            aria-expanded="false"
            title="Pengaturan"
          >
            <i class="fa fa-cog text-lg text-slate-500 hover:text-fuchsia-500 transition"></i>
          </button>
          <!-- Dropdown menu, mirip pesan, tanpa arrow -->
          <ul
            id="settingDropdownMenu"
            class="hidden absolute left-1/2 mt-2 z-50 min-w-[160px] bg-white rounded-xl shadow-2xl ring-1 ring-black/5 py-2 transition-all duration-200 animate-fade-in"
            style="transform: translateX(-50%);"
          >
            <li>
              <a href="<?= base_url('petugas/profile') ?>"
                class="flex items-center gap-2 px-5 py-2 text-sm text-slate-700 hover:bg-fuchsia-50 hover:text-fuchsia-600 rounded-xl transition font-medium"
              >
                <span class="w-6 h-6 flex items-center justify-center rounded-full bg-fuchsia-100 text-fuchsia-500">
                  <i class="fa fa-user"></i>
                </span>
                Profile
              </a>
            </li>
            <li>
              <a href="<?= base_url('logout') ?>"
                class="flex items-center gap-2 px-5 py-2 text-sm font-semibold text-red-500 hover:bg-red-50 rounded-xl transition"
              >
                <span class="w-6 h-6 flex items-center justify-center rounded-full bg-red-100 text-red-500">
                  <i class="fa fa-sign-out-alt"></i>
                </span>
                Logout
              </a>
            </li>
          </ul>
        </li>
        <?php endif; ?>

      </ul>
    </div>
  </div>
</nav>

<!-- Script Dropdowns -->
<script>
// Dropdown Pengaturan
const settingBtn = document.getElementById('settingDropdownBtn');
const settingMenu = document.getElementById('settingDropdownMenu');
if(settingBtn) {
  settingBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    settingMenu.classList.toggle('hidden');
  });
  document.addEventListener('click', function(e) {
    if (!document.getElementById('settingDropdown').contains(e.target)) {
      settingMenu.classList.add('hidden');
    }
  });
}

// Dropdown Notifikasi
const notifBtn = document.getElementById('notifDropdownBtn');
const notifMenu = document.getElementById('notifDropdownMenu');
if(notifBtn) {
  notifBtn.addEventListener('click', function(e) {
    e.stopPropagation();
    notifMenu.classList.toggle('hidden');
  });
  document.addEventListener('click', function(e) {
    if (!notifBtn.contains(e.target)) {
      notifMenu.classList.add('hidden');
    }
  });
}
</script>
