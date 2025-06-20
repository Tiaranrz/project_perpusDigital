<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cetak Laporan Peminjaman Buku</title>
  <link rel="icon" type="image/png" href="<?= base_url('images/LOGO SMK MB.png') ?>" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', Arial, sans-serif !important; background: #fff; }
    @media print { .no-print { display: none !important; } }
    .gold { color: #fbbf24; }
    .gold-bg { background: #fffbe6; }
    /* Premium effect */
    .table-premium thead tr { background: linear-gradient(90deg,#a21caf 30%,#fbbf24 100%); color: #fff;}
    .table-premium tbody tr:nth-child(even) { background-color: #f3e8ff; }
    .table-premium tbody tr:nth-child(odd)  { background-color: #fff; }
    .table-premium th, .table-premium td { border-color: #f3e8ff !important; }
    .shadow-gold { box-shadow: 0 4px 20px 0 #fde68a60; }
    .header-border { border-bottom: 3px solid #a21caf; }
  </style>
</head>
<body class="p-0 m-0 text-xs">

  <div class="max-w-3xl mx-auto mt-8 mb-4 px-6">
    <!-- Header Brand -->
    <div class="flex items-center gap-5 mb-4">
      <div class="rounded-full border-4 border-fuchsia-700 bg-white p-2 shadow-gold">
        <img src="<?= base_url('images/LOGO SMK MB.png') ?>" class="h-12 w-12 object-contain" alt="Logo">
      </div>
      <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-fuchsia-700 tracking-wide mb-1" style="letter-spacing:0.04em;">
          LAPORAN <span class="gold">PEMINJAMAN BUKU</span>
        </h1>
        <div class="text-sm text-slate-500 font-semibold mb-1">SMK MA'ARIF BANYURESMI</div>
        <div class="text-xs text-gray-400 font-medium italic">
          <?= $from && $to ? "Periode: <span class='text-fuchsia-700 font-bold'>".date('d/m/Y',strtotime($from))."</span> s.d. <span class='text-fuchsia-700 font-bold'>".date('d/m/Y',strtotime($to))."</span>" : "" ?>
        </div>
      </div>
    </div>
    <hr class="header-border mb-6">

    <!-- Table -->
    <div class="rounded-xl overflow-hidden shadow-lg gold-bg border border-fuchsia-200">
      <table class="min-w-full table-premium border border-fuchsia-100 text-xs md:text-sm">
        <thead>
          <tr>
            <th class="py-2 px-3 text-left font-semibold">No</th>
            <th class="py-2 px-3 text-left font-semibold">Nama Siswa</th>
            <th class="py-2 px-3 text-left font-semibold">Judul Buku</th>
            <th class="py-2 px-3 text-left font-semibold">Tgl. Pinjam</th>
            <th class="py-2 px-3 text-left font-semibold">Tgl. Kembali</th>
            <th class="py-2 px-3 text-left font-semibold">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($reports as $i => $r): ?>
            <tr>
              <td class="py-2 px-3"><?= $i+1 ?></td>
              <td class="py-2 px-3"><?= esc($r['username']) ?></td>
              <td class="py-2 px-3"><?= esc($r['judul']) ?></td>
              <td class="py-2 px-3"><?= date('d/m/Y', strtotime($r['tanggal_pinjam'])) ?></td>
              <td class="py-2 px-3"><?= $r['tanggal_kembali'] ? date('d/m/Y', strtotime($r['tanggal_kembali'])) : '-' ?></td>
              <td class="py-2 px-3 capitalize">
                <?php if($r['status']=='approved'): ?>
                  <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-100 text-green-800 rounded font-semibold">
                    <i class="fa fa-check-circle"></i> Approved
                  </span>
                <?php elseif($r['status']=='pending'): ?>
                  <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded font-semibold">
                    <i class="fa fa-hourglass-half"></i> Pending
                  </span>
                <?php elseif($r['status']=='rejected'): ?>
                  <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-red-100 text-red-800 rounded font-semibold">
                    <i class="fa fa-times-circle"></i> Rejected
                  </span>
                <?php else: ?>
                  <?= esc($r['status']) ?>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>
          <?php if(count($reports) == 0): ?>
            <tr>
              <td colspan="6" align="center" class="text-slate-400 py-5 font-semibold italic bg-white">
                <i class="fa fa-circle-info mr-2 text-fuchsia-500"></i> Tidak ada data transaksi pada periode ini
              </td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>

    <!-- Footer TTD -->
    <div class="flex justify-end mt-10">
      <div class="text-right">
        <div class="font-semibold mb-10">
          Garut, <?= date('d F Y') ?><br>
          <span class="text-fuchsia-700">Petugas Perpustakaan</span>
        </div>
        <div style="height:55px"></div>
        <div class="font-bold underline text-fuchsia-900">____________________</div>
      </div>
    </div>
    <!-- Tombol Print (di bawah table) -->
<button
  id="btnPrint"
  class="no-print mt-8 px-6 py-2 rounded-lg bg-fuchsia-700 text-white font-bold text-base shadow hover:bg-fuchsia-800 transition flex items-center gap-2 mx-auto block"
>
  <i class="fa fa-print"></i> Print
</button>

  </div>
  <script>
  document.getElementById('btnPrint').onclick = function() {
    window.print();
  };
  // Auto print jika akses dari tombol cetak
  if (window.location.search.includes('auto=1')) {
    window.onload = function() { window.print(); }
  }
</script>

</body>
</html>
