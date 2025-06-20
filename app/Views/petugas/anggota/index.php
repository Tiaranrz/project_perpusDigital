<?= $this->extend('petugas/layouts/main') ?>
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="flex items-center text-gray-500 text-xs md:text-sm mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <li class="inline-flex items-center">
      <a href="<?= base_url('petugas/dashboard') ?>" class="inline-flex items-center text-gray-500 hover:text-fuchsia-600 transition">
        <i class="fa fa-home mr-2"></i> Dashboard
      </a>
    </li>
    <li>
      <div class="flex items-center">
        <i class="fa fa-chevron-right mx-2 text-slate-400"></i>
        <span class="ml-1 text-fuchsia-600 font-semibold">Daftar Anggota</span>
      </div>
    </li>
  </ol>
</nav>

<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-4">
  <h1 class="text-xl font-bold text-slate-700 flex items-center gap-2">
    <i class="fa fa-users text-fuchsia-500"></i> Daftar Anggota (Siswa)
  </h1>
  <div></div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
  <?php foreach ($anggota as $a): ?>
    <div class="bg-white shadow-lg rounded-2xl p-4 flex flex-col items-center border border-fuchsia-100 hover:shadow-xl transition group">
      <div class="relative mb-3">
        <img src="<?= base_url('uploads/profiles/' . ($a['profile_image'] ?? 'default.png')) ?>"
             alt="Foto <?= esc($a['username']) ?>"
             class="w-20 h-20 rounded-full border-4 border-fuchsia-200 shadow group-hover:scale-105 object-cover bg-white"
             onerror="this.onerror=null;this.src='<?= base_url('uploads/profiles/default.png') ?>';">
        <span class="absolute -bottom-2 right-2 bg-fuchsia-500 text-white px-2 py-0.5 rounded-full text-xs shadow">
          Siswa
        </span>
      </div>
      <div class="text-center">
        <div class="text-base font-bold text-fuchsia-700"><?= esc($a['username']) ?></div>
        <div class="text-xs text-gray-400 mt-1">
          <i class="fa fa-id-card mr-1"></i> #<?= esc($a['id']) ?>
        </div>
      </div>
    </div>
  <?php endforeach ?>
  <?php if(empty($anggota)): ?>
    <div class="col-span-full text-center text-slate-400 mt-4">Tidak ada anggota siswa.</div>
  <?php endif ?>
</div>

<?= $this->endSection() ?>
