<?= $this->extend('petugas/layouts/main') ?>
<?= $this->section('content') ?>

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
        <span class="ml-1 text-fuchsia-600 font-semibold">Laporan Transaksi</span>
      </div>
    </li>
  </ol>
</nav>

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 gap-4">
  <div>
    <h1 class="text-xl font-bold text-fuchsia-700 flex items-center gap-2">
      <i class="fa fa-file-alt"></i> Laporan Transaksi Buku
    </h1>
    <div class="text-xs text-gray-400 mt-1">Filter periode untuk harian/mingguan.</div>
  </div>
  <form class="flex flex-wrap gap-2" method="get" action="<?= base_url('petugas/laporan') ?>">
    <input type="date" name="from" value="<?= esc($from) ?>" class="border border-fuchsia-200 rounded px-2 py-1 text-sm" required>
    <span class="mt-2 md:mt-0">s/d</span>
    <input type="date" name="to" value="<?= esc($to) ?>" class="border border-fuchsia-200 rounded px-2 py-1 text-sm" required>
    <button class="px-3 py-1 rounded bg-fuchsia-500 text-white text-sm hover:bg-fuchsia-600 flex items-center gap-1">
      <i class="fa fa-filter"></i> Filter
    </button>
    <a href="<?= base_url('petugas/laporan/print?from=' . $from . '&to=' . $to) ?>" target="_blank"
       class="px-3 py-1 rounded bg-green-600 text-white text-sm hover:bg-green-700 flex items-center gap-1 ml-2">
      <i class="fa fa-print"></i> Cetak
    </a>
  </form>
</div>

<div class="bg-white rounded-2xl shadow-lg border border-fuchsia-100 p-4 overflow-x-auto">
  <table class="min-w-full text-xs border rounded-lg overflow-hidden">
    <thead class="bg-fuchsia-50">
      <tr>
        <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">No</th>
        <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Nama Siswa</th>
        <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Judul Buku</th>
        <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Tgl. Pinjam</th>
        <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Tgl. Kembali</th>
        <th class="px-3 py-2 text-left font-bold text-fuchsia-700 uppercase">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($reports as $i => $r): ?>
        <tr class="odd:bg-white even:bg-fuchsia-50 group hover:bg-fuchsia-100 transition">
          <td class="px-3 py-2"><?= $i+1 ?></td>
          <td class="px-3 py-2"><?= esc($r['username']) ?></td>
          <td class="px-3 py-2"><?= esc($r['judul']) ?></td>
          <td class="px-3 py-2"><?= date('d/m/Y', strtotime($r['tanggal_pinjam'])) ?></td>
          <td class="px-3 py-2"><?= $r['tanggal_kembali'] ? date('d/m/Y', strtotime($r['tanggal_kembali'])) : '-' ?></td>
          <td class="px-3 py-2 capitalize"><?= esc($r['status']) ?></td>
        </tr>
      <?php endforeach ?>
      <?php if(count($reports) == 0): ?>
        <tr><td colspan="6" align="center" class="text-slate-400 py-3">Tidak ada data</td></tr>
      <?php endif ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
