<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="text-xs text-gray-500 mb-4" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <li><a href="<?= base_url('admin/dashboard') ?>" class="hover:text-fuchsia-600"><i class="fa fa-home mr-1"></i> Dashboard</a></li>
    <li>></li>
    <li class="text-fuchsia-700 font-semibold">Manajemen Peminjaman</li>
  </ol>
</nav>

<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-2">
  <h2 class="text-xl font-bold text-slate-700 flex items-center gap-2">
    <i class="fa fa-sync-alt text-fuchsia-700"></i> Daftar Peminjaman Buku
  </h2>
  <a href="<?= base_url('admin/peminjaman/add') ?>" class="inline-flex items-center gap-1 px-4 py-2 rounded-lg bg-fuchsia-600 text-white font-semibold shadow hover:bg-fuchsia-700 transition text-sm">
    <i class="fa fa-plus"></i> Tambah Peminjaman
  </a>
</div>

<!-- Search & Filter -->
<form class="flex flex-col md:flex-row md:items-center gap-2 mb-4" method="get">
  <input type="text" name="q" placeholder="Cari siswa/buku..." value="<?= esc($search ?? '') ?>"
         class="px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm w-full md:w-52" />
  <select name="status" class="px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm w-full md:w-40">
    <option value="">Semua Status</option>
    <option value="pending" <?= ($status ?? '')=='pending' ? 'selected' : '' ?>>Pending</option>
    <option value="approved" <?= ($status ?? '')=='approved' ? 'selected' : '' ?>>Approved</option>
    <option value="rejected" <?= ($status ?? '')=='rejected' ? 'selected' : '' ?>>Rejected</option>
    <option value="dikembalikan" <?= ($status ?? '')=='dikembalikan' ? 'selected' : '' ?>>Returned</option>
  </select>
  <button type="submit" class="px-4 py-2 rounded bg-fuchsia-500 text-white hover:bg-fuchsia-700 text-sm">
    <i class="fa fa-search"></i> Cari
  </button>
</form>

<div class="overflow-x-auto rounded-2xl shadow-lg border border-fuchsia-100 bg-white">
  <table class="w-full text-sm">
    <thead class="bg-fuchsia-50 text-fuchsia-700">
      <tr>
        <th class="py-3 px-2 text-left">No</th>
        <th class="py-3 px-2 text-left">Nama Siswa</th>
        <th class="py-3 px-2 text-left">Judul Buku</th>
        <th class="py-3 px-2 text-left">Pinjam</th>
        <th class="py-3 px-2 text-left">Kembali</th>
        <th class="py-3 px-2 text-left">Status</th>
        <th class="py-3 px-2 text-left">Aksi</th>
      </tr>
    </thead>
    <tbody class="divide-y divide-fuchsia-50">
      <?php foreach($loans as $i => $row): ?>
        <tr class="hover:bg-fuchsia-50/30">
          <td class="py-2 px-2"><?= ($pager->getCurrentPage() - 1) * $pager->getPerPage() + $i + 1 ?></td>
          <td class="py-2 px-2"><?= esc($row['username']) ?></td>
          <td class="py-2 px-2"><?= esc($row['judul']) ?></td>
          <td class="py-2 px-2"><?= esc(date('d/m/Y', strtotime($row['tanggal_pinjam']))) ?></td>
          <td class="py-2 px-2"><?= esc(date('d/m/Y', strtotime($row['tanggal_kembali']))) ?></td>
          <td class="py-2 px-2">
            <?php if($row['status']=='pending'): ?>
              <span class="inline-block px-3 py-1 bg-yellow-200 text-yellow-800 rounded-lg text-xs font-semibold shadow">Pending</span>
            <?php elseif($row['status']=='approved'): ?>
              <span class="inline-block px-3 py-1 bg-blue-200 text-blue-800 rounded-lg text-xs font-semibold shadow">Approved</span>
            <?php elseif($row['status']=='rejected'): ?>
              <span class="inline-block px-3 py-1 bg-red-200 text-red-800 rounded-lg text-xs font-semibold shadow">Rejected</span>
            <?php elseif($row['status']=='dikembalikan'): ?>
              <span class="inline-block px-3 py-1 bg-green-200 text-green-800 rounded-lg text-xs font-semibold shadow">Returned</span>
            <?php endif ?>
          </td>
          <td class="py-2 px-2 flex gap-1">
            <?php if($row['status']=='pending'): ?>
              <a href="<?= base_url('admin/peminjaman/approve/'.$row['id']) ?>" class="px-3 py-1 rounded bg-green-600 text-white text-xs font-bold hover:bg-green-700 transition" title="Approve"><i class="fa fa-check"></i></a>
              <a href="<?= base_url('admin/peminjaman/reject/'.$row['id']) ?>" class="px-3 py-1 rounded bg-red-500 text-white text-xs font-bold hover:bg-red-700 transition" title="Reject"><i class="fa fa-times"></i></a>
            <?php elseif($row['status']=='approved'): ?>
              <a href="<?= base_url('admin/peminjaman/return/'.$row['id']) ?>" class="px-3 py-1 rounded bg-fuchsia-600 text-white text-xs font-bold hover:bg-fuchsia-700 transition" title="Kembalikan"><i class="fa fa-undo"></i></a>
            <?php endif ?>
            <a href="<?= base_url('admin/peminjaman/delete/'.$row['id']) ?>" onclick="return confirm('Hapus data ini?')" class="px-3 py-1 rounded bg-gray-400 text-white text-xs font-bold hover:bg-gray-600 transition" title="Hapus"><i class="fa fa-trash"></i></a>
          </td>
        </tr>
      <?php endforeach ?>
      <?php if(count($loans) === 0): ?>
        <tr><td colspan="7" class="py-4 text-center text-gray-400">Belum ada data peminjaman.</td></tr>
      <?php endif ?>
    </tbody>
  </table>
</div>

<!-- PAGINATION -->
<div class="mt-4">
  <?= $pager->links('default', 'tailwind_full') ?>
</div>

<?= $this->endSection() ?>
