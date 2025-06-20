<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Peminjaman Buku</title>
    <link rel="icon" type="image/png" href="<?= base_url('images/LOGO SMK MB.png') ?>" />
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      @media print {
        .no-print { display: none !important; }
        body { background: #fff !important; }
        .print\:shadow-none { box-shadow: none !important; }
      }
    </style>
</head>
<body class="bg-fuchsia-50 min-h-screen py-8">
  <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-2xl print:shadow-none px-8 py-8">
    <!-- Header -->
    <div class="flex items-center gap-4 mb-4">
      <img src="<?= base_url('images/LOGO SMK MB.png') ?>" alt="Logo" class="h-16 w-16 bg-white object-contain ">
      <div>
        <h1 class="text-2xl font-bold text-fuchsia-700 flex items-center gap-2 mb-1">
          <i class="fa-solid fa-file-lines"></i> Laporan Peminjaman Buku
        </h1>
        <div class="text-gray-500 text-base">
          <?= $from && $to ? "Periode: <span class='font-semibold text-fuchsia-700'>".date('d/m/Y',strtotime($from))."</span> s.d. <span class='font-semibold text-fuchsia-700'>".date('d/m/Y',strtotime($to))."</span>" : "" ?>
        </div>
      </div>
    </div>
    <hr class="border-fuchsia-100 my-4">

    <!-- Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full border border-fuchsia-100 rounded-xl shadow-sm">
        <thead class="bg-fuchsia-50">
          <tr>
            <th class="py-2 px-4 text-xs text-fuchsia-800 font-semibold text-left border-b">No</th>
            <th class="py-2 px-4 text-xs text-fuchsia-800 font-semibold text-left border-b"><i class="fa fa-user mr-1"></i> Nama Siswa</th>
            <th class="py-2 px-4 text-xs text-fuchsia-800 font-semibold text-left border-b"><i class="fa fa-book mr-1"></i> Judul Buku</th>
            <th class="py-2 px-4 text-xs text-fuchsia-800 font-semibold text-left border-b"><i class="fa fa-calendar-check mr-1"></i> Tgl. Pinjam</th>
            <th class="py-2 px-4 text-xs text-fuchsia-800 font-semibold text-left border-b"><i class="fa fa-calendar-day mr-1"></i> Tgl. Kembali</th>
            <th class="py-2 px-4 text-xs text-fuchsia-800 font-semibold text-left border-b"><i class="fa fa-info-circle mr-1"></i> Status</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          <?php foreach($reports as $i => $r): ?>
          <tr class="even:bg-fuchsia-50/50 hover:bg-fuchsia-100/30 transition">
            <td class="py-2 px-4 text-gray-700"><?= $i+1 ?></td>
            <td class="py-2 px-4"><?= esc($r['username']) ?></td>
            <td class="py-2 px-4"><?= esc($r['judul']) ?></td>
            <td class="py-2 px-4"><?= date('d/m/Y', strtotime($r['tanggal_pinjam'])) ?></td>
            <td class="py-2 px-4"><?= $r['tanggal_kembali'] ? date('d/m/Y', strtotime($r['tanggal_kembali'])) : '-' ?></td>
            <td class="py-2 px-4">
              <?php
                $color = match($r['status']) {
                  'approved' => 'bg-green-100 text-green-600 border-green-400',
                  'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-400',
                  'rejected' => 'bg-red-100 text-red-600 border-red-400',
                  default => 'bg-gray-100 text-gray-600 border-gray-400'
                };
                $icon = match($r['status']) {
                  'approved' => 'fa-circle-check',
                  'pending' => 'fa-hourglass-half',
                  'rejected' => 'fa-times-circle',
                  default => 'fa-info-circle'
                };
              ?>
              <span class="inline-flex items-center gap-1 px-2 py-1 rounded-lg text-xs font-bold border <?= $color ?>">
                <i class="fa-solid <?= $icon ?>"></i> <?= ucfirst($r['status']) ?>
              </span>
            </td>
          </tr>
          <?php endforeach ?>
          <?php if(count($reports) == 0): ?>
            <tr>
              <td colspan="6" class="py-6 text-center text-gray-400 text-base font-semibold">
                <i class="fa fa-exclamation-circle mr-2"></i>Tidak ada data
              </td>
            </tr>
          <?php endif ?>
        </tbody>
      </table>
    </div>

    <!-- Footer -->
    <div class="flex justify-between items-center mt-8 text-sm text-gray-400 print:hidden">
      <span>Dicetak pada: <?= date('d/m/Y H:i') ?></span>
      <button onclick="window.print()" class="no-print bg-fuchsia-700 hover:bg-fuchsia-800 text-white px-6 py-2 rounded-xl shadow font-semibold flex items-center gap-2 transition">
        <i class="fa fa-print"></i> Print
      </button>
    </div>
  </div>
</body>
</html>
