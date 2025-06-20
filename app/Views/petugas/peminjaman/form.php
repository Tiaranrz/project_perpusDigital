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
        <a href="<?= base_url('petugas/peminjaman') ?>" class="ml-1 text-gray-500 hover:text-fuchsia-600 transition">Peminjaman Buku</a>
      </div>
    </li>
    <li>
      <div class="flex items-center">
        <i class="fa fa-chevron-right mx-2 text-slate-400"></i>
        <span class="ml-1 text-fuchsia-600 font-semibold"><?= isset($peminjaman) ? 'Edit Peminjaman' : 'Tambah Peminjaman' ?></span>
      </div>
    </li>
  </ol>
</nav>

<div class="mx-auto max-w-lg bg-white px-4 py-6 rounded-2xl shadow-lg border border-fuchsia-100 mb-8">
  <div class="text-center mb-5">
    <h2 class="text-lg font-bold text-fuchsia-700 inline-flex items-center gap-2 mb-1">
      <i class="fa fa-exchange-alt text-base"></i>
      <?= isset($peminjaman) ? 'Edit Peminjaman Buku' : 'Tambah Peminjaman Buku' ?>
    </h2>
  </div>

  <?php if(session()->getFlashdata('errors')): ?>
    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 border border-red-200 text-sm">
      <?php foreach(session()->getFlashdata('errors') as $error): ?>
        <div><i class="fa fa-times-circle mr-2"></i><?= $error ?></div>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <form action="<?= esc($form_action) ?>" method="post" class="space-y-4" autocomplete="off">
    <?= csrf_field() ?>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-user text-fuchsia-400 mr-1"></i> Nama Siswa
      </label>
      <select name="id_user" required class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm">
        <option value="">Pilih Siswa</option>
        <?php foreach($siswa as $s): ?>
          <option value="<?= $s['id'] ?>" <?= old('id_user', $peminjaman['id_user'] ?? '') == $s['id'] ? 'selected' : '' ?>><?= esc($s['username']) ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-book text-fuchsia-400 mr-1"></i> Judul Buku
      </label>
      <select name="id_book" required class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm">
        <option value="">Pilih Buku</option>
        <?php foreach($buku as $b): ?>
          <option value="<?= $b['id'] ?>" <?= old('id_book', $peminjaman['id_book'] ?? '') == $b['id'] ? 'selected' : '' ?>><?= esc($b['judul']) ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-calendar text-fuchsia-400 mr-1"></i> Tanggal Pinjam
      </label>
      <input type="date" name="tanggal_pinjam" value="<?= old('tanggal_pinjam', $peminjaman['tanggal_pinjam'] ?? date('Y-m-d')) ?>"
        class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm" required>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-calendar-check text-fuchsia-400 mr-1"></i> Tanggal Kembali
      </label>
      <input type="date" name="tanggal_kembali" value="<?= old('tanggal_kembali', $peminjaman['tanggal_kembali'] ?? '') ?>"
        class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm">
    </div>
    <!-- Tombol -->
    <div class="flex flex-col sm:flex-row justify-end gap-2 mt-6">
      <a href="<?= base_url('petugas/peminjaman') ?>"
        class="w-full sm:w-auto px-5 py-2 rounded-lg border border-gray-200 bg-gray-50 text-slate-600 hover:bg-gray-100 transition flex items-center justify-center gap-2 text-sm">
        <i class="fa fa-arrow-left"></i> Batal
      </a>
      <button type="submit"
        class="w-full sm:w-auto px-6 py-2 rounded-lg bg-fuchsia-600 text-white font-semibold shadow hover:bg-fuchsia-700 transition flex items-center justify-center gap-2 text-sm">
        <i class="fa fa-save"></i> <?= isset($peminjaman) ? 'Update' : 'Simpan' ?>
      </button>
    </div>
  </form>
</div>
<?= $this->endSection() ?>
