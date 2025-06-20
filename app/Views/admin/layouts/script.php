<!-- app/Views/layouts/script.php -->
<!-- <script src="<?= base_url('assets/js/plugins/chartjs.min.js') ?>" async></script>
<script src="<?= base_url('assets/js/plugins/perfect-scrollbar.min.js') ?>" async></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="<?= base_url('assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5') ?>" async></script> -->

<!-- Script untuk dropdown sederhana (bisa ditempatkan di script.php kalau mau global) -->
<script>
  document.querySelectorAll('.group.relative').forEach(function(drop) {
    drop.addEventListener('mouseleave', function() {
      drop.classList.remove('open');
    });
  });
</script>


<script>
document.getElementById('quickSettingForm').onsubmit = function(e) {
  e.preventDefault();
  const fd = new FormData(this);
  fetch(this.action, {
    method: 'POST',
    body: fd,
    headers: {'X-Requested-With': 'XMLHttpRequest'}
  }).then(r => r.json())
  .then(json => {
    document.getElementById('quickSettingResult').innerHTML = json.status == 'ok'
      ? '<span class="text-green-600">'+json.message+'</span>'
      : '<span class="text-red-600">'+json.message+'</span>';
    if(json.status == 'ok') setTimeout(()=>location.reload(), 1000);
  }).catch(() => {
    document.getElementById('quickSettingResult').innerHTML = '<span class="text-red-600">Gagal update!</span>';
  });
}
</script>
