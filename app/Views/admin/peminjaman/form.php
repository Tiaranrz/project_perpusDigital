<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <li><a href="<?= base_url('admin/dashboard') ?>" class="hover:text-fuchsia-600"><i class="fa fa-home mr-1"></i> Dashboard</a></li>
    <li>></li>
    <li><a href="<?= base_url('admin/peminjaman') ?>" class="hover:text-fuchsia-600">Peminjaman</a></li>
    <li>></li>
    <li class="text-fuchsia-700 font-semibold">Tambah</li>
  </ol>
</nav>

<div class="mx-auto max-w-lg bg-white px-6 py-8 rounded-2xl shadow-lg border border-fuchsia-100 mb-8">
  <div class="text-center mb-5">
    <h2 class="text-xl font-bold  text-slate-700 flex items-center gap-2 mb-1">
      <i class="fa fa-sync-alt text-fuchsia-700"></i> Tambah Peminjaman Buku
    </h2>
  </div>

  <?php if(session()->getFlashdata('errors')): ?>
    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 border border-red-200 text-sm">
      <?= implode('<br>', (array) session('errors')) ?>
    </div>
  <?php endif ?>

  <form action="<?= base_url('admin/peminjaman/save') ?>" method="post" class="space-y-3">
    <?= csrf_field() ?>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm"><i class="fa fa-user mr-1 text-fuchsia-400"></i> Pilih Siswa</label>
      <select name="id_user" required class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400">
        <option value="">Pilih siswa</option>
        <?php foreach($users as $user): ?>
          <option value="<?= $user['id'] ?>"><?= esc($user['username']) ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm"><i class="fa fa-book mr-1 text-fuchsia-400"></i> Pilih Buku</label>
      <select name="id_book" required class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400">
        <option value="">Pilih buku</option>
        <?php foreach($books as $book): ?>
          <option value="<?= $book['id'] ?>"><?= esc($book['judul']) ?> (Sisa: <?= $book['sisa'] ?>)</option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="flex gap-2">
      <div class="w-1/2">
        <label class="block mb-1 font-medium text-slate-700 text-sm"><i class="fa fa-calendar-alt mr-1 text-fuchsia-400"></i> Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400" required>
      </div>
      <div class="w-1/2">
        <label class="block mb-1 font-medium text-slate-700 text-sm"><i class="fa fa-calendar-check mr-1 text-fuchsia-400"></i> Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400" required>
      </div>
    </div>
    <div class="flex flex-col sm:flex-row justify-end gap-2 mt-6">
      <a href="<?= base_url('admin/peminjaman') ?>" class="w-full sm:w-auto px-5 py-2 rounded-lg border border-gray-200 bg-gray-50 text-slate-600 hover:bg-gray-100 transition flex items-center justify-center gap-2 text-sm"><i class="fa fa-arrow-left"></i> Batal</a>
      <button type="submit" class="w-full sm:w-auto px-6 py-2 rounded-lg bg-fuchsia-600 text-white font-semibold shadow hover:bg-fuchsia-700 transition flex items-center justify-center gap-2 text-sm"><i class="fa fa-save"></i> Simpan</button>
    </div>
  </form>
</div>
<?= $this->endSection() ?>
