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
        <span class="ml-1 text-fuchsia-600 font-semibold">Manajemen Buku</span>
      </div>
    </li>
  </ol>
</nav>

<!-- Header, Search & Tambah Buku -->
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
  <div class="flex flex-col gap-3 w-full sm:w-auto">
    <div class="flex items-center gap-2">
      <i class="fa fa-book text-fuchsia-500 text-xl"></i>
      <h1 class="text-xl font-bold text-slate-700">Manajemen Buku</h1>
    </div>
    <!-- Form Search -->
    <form method="get" class="flex items-center mt-2 mb-2 w-full max-w-xs gap-2">
      <input name="q" type="text" value="<?= esc($search) ?>" placeholder="Cari judul/penulis/ISBN..."
        class="px-3 py-2 w-full border border-fuchsia-200 rounded-l focus:outline-none focus:ring-1 focus:ring-fuchsia-400 text-sm" />
      <select name="kategori" class="px-2 py-2 border-y border-fuchsia-200 text-sm bg-white focus:outline-none">
        <option value="">Semua Kategori</option>
        <?php foreach($categories as $cat): ?>
          <option value="<?= $cat['id'] ?>" <?= $kategori == $cat['id'] ? 'selected' : '' ?>>
            <?= esc($cat['nama']) ?>
          </option>
        <?php endforeach ?>
      </select>
      <button type="submit" class="px-3 py-2 bg-fuchsia-500 text-white rounded-r hover:bg-fuchsia-600 text-sm">
        <i class="fa fa-search"></i>
      </button>
    </form>
  </div>
  <div class="flex justify-center w-full sm:w-auto mt-2 sm:mt-0">
    <a href="<?= base_url('admin/books/add') ?>"
       class="px-6 py-2 bg-fuchsia-500 text-white rounded-md shadow hover:bg-fuchsia-600 text-sm font-semibold flex items-center gap-2 transition"
       style="min-width:150px;justify-content:center;">
      <i class="fa fa-plus"></i> Tambah Buku
    </a>
  </div>
</div>

<!-- Flash message -->
<?php if(session()->getFlashdata('success')): ?>
    <div class="mt-4 mb-2 p-2 rounded bg-green-50 text-green-700 border border-green-200 text-xs flex items-center w-full max-w-2xl">
      <i class="fa fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
    </div>
<?php endif ?>
<?php if(session()->getFlashdata('errors')): ?>
    <div class="mt-4 mb-2 p-2 rounded bg-red-50 text-red-700 border border-red-200 text-xs flex items-center w-full max-w-2xl">
        <i class="fa fa-exclamation-circle mr-2"></i>
        <?php foreach(session()->getFlashdata('errors') as $error): ?>
            <div><?= $error ?></div>
        <?php endforeach ?>
    </div>
<?php endif ?>

<!-- Tabel -->
<div class="w-full mt-6 flex justify-start">
  <div class="bg-white p-4 rounded-2xl shadow-xl border border-fuchsia-100 w-full overflow-x-auto">
    <table class="min-w-full text-xs border rounded-lg overflow-hidden">
      <thead class="bg-fuchsia-50">
        <tr>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">No</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Cover</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Judul</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Penulis</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Kategori</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Jumlah</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Sisa</th>
          <th class="px-3 py-2 text-center font-bold text-fuchsia-700 uppercase">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($books as $i => $book): ?>
        <tr class="odd:bg-white even:bg-fuchsia-50 group hover:bg-fuchsia-100 transition">
          <td class="px-3 py-2"><?= ($perPage * ($currentPage-1)) + $i+1 ?></td>
          <td class="px-3 py-2">
            <?php if($book['cover']): ?>
              <img src="<?= base_url('uploads/covers/'.$book['cover']) ?>" class="h-10 w-8 object-cover rounded shadow" alt="cover">
            <?php else: ?>
              <div class="h-10 w-8 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                <i class="fa fa-book"></i>
              </div>
            <?php endif ?>
          </td>
          <td class="px-3 py-2 font-medium"><?= esc($book['judul']) ?></td>
          <td class="px-3 py-2"><?= esc($book['penulis']) ?></td>
          <td class="px-3 py-2"><?= esc($book['kategori']) ?></td>
          <td class="px-3 py-2"><?= esc($book['jumlah']) ?></td>
          <td class="px-3 py-2"><?= esc($book['sisa']) ?></td>
          <td class="px-3 py-2">
            <div class="flex items-center justify-center gap-2">
              <a href="<?= base_url('admin/books/edit/'.$book['id']) ?>"
                class="text-blue-500 hover:bg-blue-100 p-1 rounded transition" title="Edit">
                <i class="fa fa-edit text-base"></i>
              </a>
              <a href="<?= base_url('admin/books/delete/'.$book['id']) ?>"
                class="text-red-500 hover:bg-red-100 p-1 rounded transition" onclick="return confirm('Yakin hapus buku?')" title="Hapus">
                <i class="fa fa-trash text-base"></i>
              </a>
            </div>
          </td>
        </tr>
        <?php endforeach ?>
        <?php if (empty($books)): ?>
        <tr>
          <td class="px-3 py-2 text-center text-slate-400" colspan="8">Tidak ada data buku</td>
        </tr>
        <?php endif ?>
      </tbody>
    </table>
    <!-- Pagination -->
    <?php if (isset($pager)) : ?>
      <div class="mt-4 flex justify-center">
        <?= $pager->links('books', 'tailwind_full') ?>
      </div>
    <?php endif ?>
  </div>
</div>

<?= $this->endSection() ?>
