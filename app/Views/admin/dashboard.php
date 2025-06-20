<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<!-- Ringkasan -->
<div class="flex flex-wrap justify-center gap-6 mt-8 mb-8">
    <!-- Total Buku -->
    <div class="w-full sm:w-[250px] rounded-2xl shadow-lg bg-white px-6 py-6 flex flex-col items-center group hover:scale-105 transition-all duration-200 ease-in">
        <div class="mb-4">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-br from-fuchsia-500 to-pink-400 shadow-lg">
                <i class="fa fa-book text-white text-2xl"></i>
            </div>
        </div>
        <div class="text-center">
            <div class="text-sm text-slate-400 font-semibold mb-1">Total Buku</div>
            <div class="text-3xl font-bold text-fuchsia-700"><?= $totalBuku ?></div>
        </div>
    </div>
    <!-- Total Siswa -->
    <div class="w-full sm:w-[250px] rounded-2xl shadow-lg bg-white px-6 py-6 flex flex-col items-center group hover:scale-105 transition-all duration-200 ease-in">
        <div class="mb-4">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-blue-400 shadow-lg">
                <i class="fa fa-user-graduate text-white text-2xl"></i>
            </div>
        </div>
        <div class="text-center">
            <div class="text-sm text-slate-400 font-semibold mb-1">Total Siswa</div>
            <div class="text-3xl font-bold text-cyan-600"><?= $totalSiswa ?></div>
        </div>
    </div>
    <!-- Peminjaman Hari Ini -->
    <div class="w-full sm:w-[250px] rounded-2xl shadow-lg bg-white px-6 py-6 flex flex-col items-center group hover:scale-105 transition-all duration-200 ease-in">
        <div class="mb-4">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-br from-violet-500 to-fuchsia-400 shadow-lg">
                <i class="fa fa-hand-holding text-white text-2xl"></i>
            </div>
        </div>
        <div class="text-center">
            <div class="text-sm text-slate-400 font-semibold mb-1">Peminjaman Hari Ini</div>
            <div class="text-3xl font-bold text-violet-600"><?= $pinjamHariIni ?></div>
        </div>
    </div>
    <!-- Buku Terlambat -->
    <div class="w-full sm:w-[250px] rounded-2xl shadow-lg bg-white px-6 py-6 flex flex-col items-center group hover:scale-105 transition-all duration-200 ease-in">
        <div class="mb-4">
            <div class="w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-br from-rose-500 to-pink-400 shadow-lg">
                <i class="fa fa-clock text-white text-2xl"></i>
            </div>
        </div>
        <div class="text-center">
            <div class="text-sm text-slate-400 font-semibold mb-1">Buku Terlambat</div>
            <div class="text-3xl font-bold text-rose-600"><?= $bukuTerlambat ?></div>
        </div>
    </div>
</div>

<!-- Grafik -->
<div class="flex justify-center">
  <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-6">
    <h3 class="text-lg font-bold text-fuchsia-700 mb-4 flex items-center gap-2">
      <i class="fa fa-chart-bar"></i>
      Grafik Peminjaman 7 Hari Terakhir
    </h3>
    <canvas id="chartPinjam" height="110"></canvas>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = <?= json_encode($labels ?? []) ?>;
const dataPinjam = <?= json_encode($dataPinjam ?? []) ?>;

const ctx = document.getElementById('chartPinjam').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Peminjaman',
            data: dataPinjam,
            borderWidth: 2,
            borderRadius: 10,
            backgroundColor: 'rgba(217, 70, 239, 0.8)',
            hoverBackgroundColor: 'rgba(168,85,247,0.8)',
        }]
    },
    options: {
        responsive: true,
        plugins: { 
          legend: { display: false },
          tooltip: {
            backgroundColor: "#fff",
            titleColor: "#be185d",
            bodyColor: "#7c3aed",
            borderWidth: 1,
            borderColor: "#f472b6"
          }
        },
        scales: {
            y: { 
                beginAtZero: true,
                grid: { color: "#f3e8ff" },
                ticks: { color: "#be185d" }
            },
            x: { 
                grid: { color: "#f3e8ff" },
                ticks: { color: "#a1a1aa" }
            }
        }
    }
});
</script>

<?= $this->endSection() ?>
