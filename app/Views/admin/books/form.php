<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="flex items-center text-gray-500 text-xs md:text-sm mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <li class="inline-flex items-center">
      <a href="<?= base_url('admin/dashboard') ?>" class="inline-flex items-center text-gray-500 hover:text-fuchsia-600 transition">
        <i class="fa fa-home mr-2"></i> Dashboard
      </a>
    </li>
    <li>
      <div class="flex items-center">
        <i class="fa fa-chevron-right mx-2 text-slate-400"></i>
        <a href="<?= base_url('admin/books') ?>" class="ml-1 text-gray-500 hover:text-fuchsia-600 transition">Manajemen Buku</a>
      </div>
    </li>
    <li>
      <div class="flex items-center">
        <i class="fa fa-chevron-right mx-2 text-slate-400"></i>
        <span class="ml-1 text-fuchsia-600 font-semibold"><?= isset($book) ? 'Edit Buku' : 'Tambah Buku' ?></span>
      </div>
    </li>
  </ol>
</nav>

<!-- Card Form -->
<div class="mx-auto max-w-lg bg-white px-4 py-6 rounded-2xl shadow-lg border border-fuchsia-100 mb-8">
  <div class="text-center mb-5">
    <h2 class="text-lg font-bold text-fuchsia-700 inline-flex items-center gap-2 mb-1">
      <i class="fa fa-book text-base"></i>
      <?= isset($book) ? 'Edit Buku' : 'Tambah Buku' ?>
    </h2>
  </div>

  <?php if(session()->getFlashdata('errors')): ?>
    <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-700 border border-red-200 text-sm">
      <?php foreach(session()->getFlashdata('errors') as $error): ?>
        <div><i class="fa fa-times-circle mr-2"></i><?= $error ?></div>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <form action="<?= esc($form_action) ?>" method="post" enctype="multipart/form-data" class="space-y-3" id="formBuku" autocomplete="off">
    <?= csrf_field() ?>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-book text-fuchsia-400 mr-1"></i> Judul Buku
      </label>
      <input name="judul" type="text" value="<?= old('judul', $book['judul'] ?? '') ?>"
        class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm"
        required>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-user-edit text-fuchsia-400 mr-1"></i> Penulis
      </label>
      <input name="penulis" type="text" value="<?= old('penulis', $book['penulis'] ?? '') ?>"
        class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm"
        required>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-building text-fuchsia-400 mr-1"></i> Penerbit
      </label>
      <input name="penerbit" type="text" value="<?= old('penerbit', $book['penerbit'] ?? '') ?>"
        class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm">
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-calendar text-fuchsia-400 mr-1"></i> Tahun Terbit
      </label>
      <input name="tahun_terbit" type="number" min="1900" max="<?= date('Y') ?>" value="<?= old('tahun_terbit', $book['tahun_terbit'] ?? '') ?>"
        class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm">
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-barcode text-fuchsia-400 mr-1"></i> ISBN
      </label>
      <input name="isbn" type="text" value="<?= old('isbn', $book['isbn'] ?? '') ?>"
        class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm">
    </div>
    <!-- Kategori -->
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-tags text-fuchsia-400 mr-1"></i> Kategori Buku
      </label>
      <div class="flex gap-2 items-center">
        <select id="id_kategori" name="id_kategori" required class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm">
          <option value="">Pilih Kategori</option>
          <?php foreach($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= old('id_kategori', $book['id_kategori'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
              <?= esc($cat['nama']) ?>
            </option>
          <?php endforeach ?>
        </select>
        <a href="<?= base_url('admin/categories/add') ?>"
          class="px-3 py-1.5 rounded bg-fuchsia-100 text-fuchsia-700 hover:bg-fuchsia-200 transition flex items-center gap-1 text-base"
          title="Tambah Kategori">
          <i class="fa fa-plus"></i>
        </a>
      </div>
    </div>
    <div class="flex gap-2">
      <div class="w-1/2">
        <label class="block mb-1 font-medium text-slate-700 text-sm">
          <i class="fa fa-layer-group text-fuchsia-400 mr-1"></i> Jumlah
        </label>
        <input name="jumlah" type="number" value="<?= old('jumlah', $book['jumlah'] ?? '') ?>"
          class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm" required>
      </div>
      <div class="w-1/2">
        <label class="block mb-1 font-medium text-slate-700 text-sm">
          <i class="fa fa-box text-fuchsia-400 mr-1"></i> Sisa
        </label>
        <input name="sisa" type="number" value="<?= old('sisa', $book['sisa'] ?? '') ?>"
          class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm" required>
      </div>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">
        <i class="fa fa-image text-fuchsia-400 mr-1"></i> Cover Buku
        <?php if(isset($book['cover']) && $book['cover']): ?>
          <span class="ml-2 text-xs text-gray-400">(Kosongkan jika tidak ingin mengubah cover)</span>
        <?php endif ?>
      </label>
      <input name="cover" type="file" class="w-full px-3 py-1.5 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm bg-white" accept="image/*">
      <?php if(isset($book['cover']) && $book['cover']): ?>
        <img src="<?= base_url('uploads/covers/'.$book['cover']) ?>" class="h-16 mt-2 rounded shadow border" alt="cover">
      <?php endif ?>
    </div>
    <!-- Tombol -->
    <div class="flex flex-col sm:flex-row justify-end gap-2 mt-6">
      <a href="<?= base_url('admin/books') ?>"
        class="w-full sm:w-auto px-5 py-2 rounded-lg border border-gray-200 bg-gray-50 text-slate-600 hover:bg-gray-100 transition flex items-center justify-center gap-2 text-sm">
        <i class="fa fa-arrow-left"></i> Batal
      </a>
      <button type="submit"
        class="w-full sm:w-auto px-6 py-2 rounded-lg bg-fuchsia-600 text-white font-semibold shadow hover:bg-fuchsia-700 transition flex items-center justify-center gap-2 text-sm">
        <i class="fa fa-save"></i> <?= isset($book) ? 'Update' : 'Simpan' ?>
      </button>
    </div>
  </form>
</div>
<?= $this->endSection() ?>
