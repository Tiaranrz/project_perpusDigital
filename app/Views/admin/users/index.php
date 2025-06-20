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
        <i class="fa fa-chevron-right mx-2 text-gray-400"></i>
        <a href="<?= base_url('admin/users/admin') ?>" class="ml-1 text-gray-500 hover:text-fuchsia-600 transition">Manajemen User</a>
      </div>
    </li>
    <li>
      <div class="flex items-center">
        <i class="fa fa-chevron-right mx-2 text-gray-500"></i>
        <span class="ml-1 text-fuchsia-400 font-semibold"><?= esc($role_label) ?></span>
      </div>
    </li>
  </ol>
</nav>

<!-- Header dan Form Search Kiri -->
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
  <div class="flex flex-col gap-3 w-full sm:w-auto">
    <!-- Judul -->
    <div class="flex items-center gap-2">
      <i class="fa fa-users-cog text-fuchsia-500 text-xl"></i>
      <h1 class="text-xl font-bold text-slate-700"> Manajemen <?= esc($role_label) ?></h1>
    </div>
    <!-- Tabs -->
    <div class="flex gap-2 mt-1">
      <a href="<?= base_url('admin/users/admin') ?>"
         class="flex items-center gap-1 px-3 py-1.5 rounded font-medium text-xs <?= $role=='admin' ? 'bg-fuchsia-500 text-white shadow' : 'bg-gray-100 text-slate-700 hover:bg-fuchsia-100' ?>">
        <i class="fa fa-user-shield text-base"></i> Admin
      </a>
      <a href="<?= base_url('admin/users/petugas') ?>"
         class="flex items-center gap-1 px-3 py-1.5 rounded font-medium text-xs <?= $role=='petugas' ? 'bg-fuchsia-500 text-white shadow' : 'bg-gray-100 text-slate-700 hover:bg-fuchsia-100' ?>">
        <i class="fa fa-user-cog text-base"></i> Petugas
      </a>
      <a href="<?= base_url('admin/users/siswa') ?>"
         class="flex items-center gap-1 px-3 py-1.5 rounded font-medium text-xs <?= $role=='siswa' ? 'bg-fuchsia-500 text-white shadow' : 'bg-gray-100 text-slate-700 hover:bg-fuchsia-100' ?>">
        <i class="fa fa-user-graduate text-base"></i> Siswa
      </a>
    </div>
    <!-- Form Search -->
    <form method="get" class="flex items-center mt-2 mb-2 w-full max-w-xs">
      <input name="q" type="text" value="<?= esc($search) ?>" placeholder="Cari username..."
        class="px-3 py-2 w-full border border-fuchsia-200 rounded-l focus:outline-none focus:ring-1 focus:ring-fuchsia-400 text-sm" />
      <button type="submit" class="px-3 py-2 bg-fuchsia-500 text-white rounded-r hover:bg-fuchsia-600 text-sm">
        <i class="fa fa-search"></i>
      </button>
    </form>
  </div>
  <!-- Tombol Tambah di Tengah -->
  <div class="flex justify-center w-full sm:w-auto mt-2 sm:mt-0">
    <a href="<?= base_url('admin/users/'.$role.'/add') ?>"
       class="px-6 py-2 bg-fuchsia-500 text-white rounded-md shadow hover:bg-fuchsia-600 text-sm font-semibold flex items-center gap-2 transition"
       style="min-width:150px;justify-content:center;">
      <i class="fa fa-user-plus"></i> Tambah <?= $role_label ?>
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
<!-- Tabel (container full) -->
<div class="w-full mt-6">
  <div class="bg-white p-4 rounded-2xl shadow-xl border border-fuchsia-100 w-full">
    <div class="overflow-x-auto">
      <table class="min-w-full text-xs border rounded-lg overflow-hidden">
        <thead class="bg-fuchsia-50">
          <tr>
            <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">No</th>
            <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Username</th>
            <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Role</th>
            <th class="px-3 py-2 text-center font-bold text-fuchsia-700 uppercase">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $i => $user): ?>
          <tr class="odd:bg-white even:bg-fuchsia-50 group hover:bg-fuchsia-100 transition">
            <td class="px-3 py-2"><?= $i+1 ?></td>
            <td class="px-3 py-2 font-medium"><?= esc($user['username']) ?></td>
            <td class="px-3 py-2 capitalize"><?= esc($user['role']) ?></td>
            <td class="px-3 py-2">
              <div class="flex items-center justify-center gap-2">
                <a href="<?= base_url('admin/users/'.$role.'/edit/'.$user['id']) ?>"
                   class="text-blue-500 hover:bg-blue-100 p-1 rounded transition" title="Edit">
                  <i class="fa fa-edit text-base"></i>
                </a>
                <a href="<?= base_url('admin/users/'.$role.'/password/'.$user['id']) ?>"
                   class="text-orange-500 hover:bg-orange-100 p-1 rounded transition" title="Ganti Password">
                  <i class="fa fa-key text-base"></i>
                </a>
                <a href="<?= base_url('admin/users/'.$role.'/delete/'.$user['id']) ?>"
                   class="text-red-500 hover:bg-red-100 p-1 rounded transition" onclick="return confirm('Yakin hapus user?')" title="Hapus">
                  <i class="fa fa-trash text-base"></i>
                </a>
              </div>
            </td>
          </tr>
          <?php endforeach ?>
          <?php if (empty($users)): ?>
          <tr>
            <td class="px-3 py-2 text-center text-slate-400" colspan="4">Tidak ada data user</td>
          </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>
    <!-- Pagination -->
    <?php if (isset($pager)) : ?>
      <div class="mt-4 flex justify-center">
        <?= $pager->links('default', 'pagination_tailwind') ?>
      </div>
    <?php endif ?>
  </div>
</div>


<?= $this->endSection() ?>
