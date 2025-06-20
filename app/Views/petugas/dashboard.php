<?= $this->extend('petugas/layouts/main') ?>
<?= $this->section('content') ?>

<div class="flex flex-wrap justify-center gap-6 mt-8 mb-8">
    <!-- Peminjaman Hari Ini -->
    <div class="w-full sm:w-[250px] rounded-2xl shadow-lg bg-white px-6 py-6 flex flex-col items-center">
        <div class="mb-4">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-br from-violet-500 to-fuchsia-400 shadow-lg">
                <i class="fa fa-hand-holding text-white text-2xl"></i>
            </div>
        </div>
        <div class="text-center">
            <div class="text-sm text-slate-400 font-semibold mb-1">Peminjaman Hari Ini</div>
            <div class="text-3xl font-bold text-violet-600"><?= $peminjamanHariIni ?></div>
        </div>
    </div>
    <!-- Pengembalian Hari Ini -->
    <div class="w-full sm:w-[250px] rounded-2xl shadow-lg bg-white px-6 py-6 flex flex-col items-center">
        <div class="mb-4">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-blue-400 shadow-lg">
                <i class="fa fa-undo text-white text-2xl"></i>
            </div>
        </div>
        <div class="text-center">
            <div class="text-sm text-slate-400 font-semibold mb-1">Pengembalian Hari Ini</div>
            <div class="text-3xl font-bold text-cyan-600"><?= $pengembalianHariIni ?></div>
        </div>
    </div>
</div>

<!-- Grafik -->
<div class="flex justify-center">
  <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-6">
    <h3 class="text-lg font-bold text-fuchsia-700 mb-4 flex items-center gap-2">
      <i class="fa fa-chart-bar"></i>
      Grafik Peminjaman & Pengembalian 7 Hari Terakhir
    </h3>
    <canvas id="chartPetugas" height="110"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?= json_encode($labels ?? []) ?>;
const dataPinjam = <?= json_encode($dataPinjam ?? []) ?>;
const dataKembali = <?= json_encode($dataKembali ?? []) ?>;

const ctx = document.getElementById('chartPetugas').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
          {
            label: 'Peminjaman',
            data: dataPinjam,
            backgroundColor: 'rgba(139,92,246,0.7)'
          },
          {
            label: 'Pengembalian',
            data: dataKembali,
            backgroundColor: 'rgba(34,211,238,0.7)'
          }
        ]
    },
    options: {
        responsive: true,
        plugins: { 
          tooltip: { backgroundColor: "#fff" },
          legend: { labels: { color: "#7c3aed", font: { size: 13 } } }
        },
        scales: {
            y: { beginAtZero: true, ticks: { color: "#be185d" }, grid: { color: "#f3e8ff" } },
            x: { ticks: { color: "#a1a1aa" }, grid: { color: "#f3e8ff" } }
        }
    }
});
</script>
<?= $this->endSection() ?>
