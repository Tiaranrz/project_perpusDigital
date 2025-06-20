<?= $this->extend('petugas/layouts/main') ?>
<?= $this->section('content') ?>
<!-- Breadcrumb sama seperti sebelumnya -->
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
        <span class="ml-1 text-fuchsia-600 font-semibold">Pengembalian Buku</span>
      </div>
    </li>
  </ol>
</nav>

<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4">
  <h1 class="text-xl font-bold text-slate-700 flex items-center gap-2">
    <i class="fa fa-undo text-fuchsia-500"></i> Daftar Pengembalian Buku
  </h1>
  <div class="flex justify-center w-full sm:w-auto mt-2 sm:mt-0">
    <a href="<?= base_url('petugas/pengembalian/add') ?>"
       class="px-6 py-2 bg-fuchsia-500 text-white rounded-md shadow hover:bg-fuchsia-600 text-sm font-semibold flex items-center gap-2 transition"
       style="min-width:170px;justify-content:center;">
      <i class="fa fa-plus"></i> Input Pengembalian
    </a>
  </div>
</div>

<?php if(session()->getFlashdata('success')): ?>
  <div class="mt-4 mb-2 p-2 rounded bg-green-50 text-green-700 border border-green-200 text-xs flex items-center w-full max-w-2xl">
    <i class="fa fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
  </div>
<?php endif ?>

<div class="w-full mt-6 flex justify-start">
  <div class="bg-white p-4 rounded-2xl shadow-xl border border-fuchsia-100 w-full overflow-x-auto">
    <table class="min-w-full text-xs border rounded-lg overflow-hidden">
      <thead class="bg-fuchsia-50">
        <tr>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">No</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Nama Siswa</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Judul Buku</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Tgl. Pinjam</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Jatuh Tempo</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Tgl. Kembali</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Denda</th>
          <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Keterangan</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($pengembalian as $i => $row): ?>
        <tr class="odd:bg-white even:bg-fuchsia-50 group hover:bg-fuchsia-100 transition">
          <td class="px-3 py-2"><?= $i+1 ?></td>
          <td class="px-3 py-2"><?= esc($row['username']) ?></td>
          <td class="px-3 py-2"><?= esc($row['judul']) ?></td>
          <td class="px-3 py-2"><?= date('d/m/Y', strtotime($row['tanggal_pinjam'])) ?></td>
          <td class="px-3 py-2"><?= $row['jatuh_tempo'] ? date('d/m/Y', strtotime($row['jatuh_tempo'])) : '-' ?></td>
          <td class="px-3 py-2"><?= date('d/m/Y', strtotime($row['tanggal_kembali'])) ?></td>
          <td class="px-3 py-2"><?= $row['denda'] ? 'Rp'.number_format($row['denda'],0,',','.') : '-' ?></td>
          <td class="px-3 py-2"><?= esc($row['keterangan']) ?></td>
        </tr>
        <?php endforeach ?>
        <?php if(empty($pengembalian)): ?>
        <tr>
          <td class="px-3 py-2 text-center text-slate-400" colspan="8">Tidak ada data pengembalian</td>
        </tr>
        <?php endif ?>
      </tbody>
    </table>
  </div>
</div>
<?= $this->endSection() ?>
