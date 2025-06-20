<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="mb-4 text-sm text-gray-500">
  <ol class="flex items-center space-x-1">
    <li><a href="<?= base_url('admin/dashboard') ?>" class="hover:text-fuchsia-600"><i class="fa fa-home mr-1"></i> Dashboard</a></li>
    <li>></li>
    <li class="text-fuchsia-700 font-semibold">Laporan Peminjaman</li>
  </ol>
</nav>

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-2">
  <div>
    <h1 class="text-xl font-bold text-slate-700 flex items-center gap-2">
      <i class="fa fa-file-alt text-fuchsia-700"></i> Laporan Peminjaman Buku
    </h1>
  </div>
  <div>
    <a href="<?= base_url('admin/laporan/cetak?' . http_build_query(['from'=>$from,'to'=>$to,'status'=>$status])) ?>" 
       target="_blank" class="px-5 py-2 bg-fuchsia-600 text-white rounded-lg shadow hover:bg-fuchsia-700 transition text-sm font-semibold">
      <i class="fa fa-print"></i> Cetak / PDF
    </a>
  </div>
</div>

<!-- Filter -->
<form class="flex flex-col sm:flex-row gap-2 mb-4" method="get">
  <input type="date" name="from" value="<?= esc($from) ?>" class="border border-fuchsia-200 rounded px-3 py-2 text-sm focus:outline-none focus:border-fuchsia-400" />
  <input type="date" name="to" value="<?= esc($to) ?>" class="border border-fuchsia-200 rounded px-3 py-2 text-sm focus:outline-none focus:border-fuchsia-400" />
  <select name="status" class="border border-fuchsia-200 rounded px-3 py-2 text-sm focus:outline-none focus:border-fuchsia-400">
    <option value="">Semua Status</option>
    <option value="pending" <?= $status=='pending'?'selected':'' ?>>Pending</option>
    <option value="approved" <?= $status=='approved'?'selected':'' ?>>Approved</option>
    <option value="rejected" <?= $status=='rejected'?'selected':'' ?>>Rejected</option>
    <option value="dikembalikan" <?= $status=='dikembalikan'?'selected':'' ?>>Returned</option>
  </select>
  <button type="submit" class="px-4 py-2 rounded bg-fuchsia-500 text-white hover:bg-fuchsia-700 text-sm flex items-center gap-1">
    <i class="fa fa-filter"></i> Filter
  </button>
</form>

<div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-fuchsia-100">
  <table class="min-w-full text-sm">
    <thead class="bg-fuchsia-50 text-fuchsia-700">
      <tr>
        <th class="py-2 px-3 text-left">No</th>
        <th class="py-2 px-3 text-left">Nama Siswa</th>
        <th class="py-2 px-3 text-left">Judul Buku</th>
        <th class="py-2 px-3 text-left">Pinjam</th>
        <th class="py-2 px-3 text-left">Kembali</th>
        <th class="py-2 px-3 text-left">Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($reports as $i => $r): ?>
        <tr class="even:bg-fuchsia-50 hover:bg-fuchsia-100/30">
          <td class="py-2 px-3"><?= $i+1 ?></td>
          <td class="py-2 px-3"><?= esc($r['username']) ?></td>
          <td class="py-2 px-3"><?= esc($r['judul']) ?></td>
          <td class="py-2 px-3"><?= date('d/m/Y', strtotime($r['tanggal_pinjam'])) ?></td>
          <td class="py-2 px-3"><?= $r['tanggal_kembali'] ? date('d/m/Y', strtotime($r['tanggal_kembali'])) : '-' ?></td>
          <td class="py-2 px-3">
            <?php if($r['status']=='pending'): ?>
              <span class="inline-block px-3 py-1 bg-yellow-100 text-yellow-700 rounded-lg text-xs font-bold shadow">Pending</span>
            <?php elseif($r['status']=='approved'): ?>
              <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-xs font-bold shadow">Approved</span>
            <?php elseif($r['status']=='rejected'): ?>
              <span class="inline-block px-3 py-1 bg-red-100 text-red-700 rounded-lg text-xs font-bold shadow">Rejected</span>
            <?php elseif($r['status']=='dikembalikan'): ?>
              <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold shadow">Returned</span>
            <?php endif ?>
          </td>
        </tr>
      <?php endforeach ?>
      <?php if(count($reports) == 0): ?>
        <tr>
          <td colspan="6" class="py-6 text-center text-gray-400">Tidak ada data untuk filter ini.</td>
        </tr>
      <?php endif ?>
    </tbody>
  </table>
</div>

<?= $this->endSection() ?>
