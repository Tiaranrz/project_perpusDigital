<?= $this->extend('petugas/layouts/main') ?>
<?= $this->section('content') ?>

<div class="max-w-xl mx-auto bg-white rounded-2xl shadow-lg p-6 mt-8">
  <h2 class="text-xl text-center font-bold text-fuchsia-700 mb-4 flex justify-center items-center gap-2">
    <i class="fa fa-user-circle"></i> Profil Saya
  </h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="mb-4 p-2 bg-green-100 border border-green-200 rounded text-green-700 text-sm">
      <?= session()->getFlashdata('success') ?>
    </div>
    <script>
      // Tunggu 1 detik, lalu reload agar navbar ambil session baru
      setTimeout(function(){
        location.reload();
      }, 1000);
    </script>
  <?php endif; ?>
  <?php if (session()->getFlashdata('errors')): ?>
    <div class="mb-4 p-2 bg-red-100 border border-red-200 rounded text-red-700 text-sm">
      <?php foreach(session()->getFlashdata('errors') as $e): ?>
        <div><?= $e ?></div>
      <?php endforeach ?>
    </div>
  <?php endif; ?>


  <form action="<?= base_url('petugas/profile/update') ?>" method="post" enctype="multipart/form-data" class="space-y-4">
    <?= csrf_field() ?>
    <div class="flex flex-col items-center mb-4">
      <img
        src="<?= base_url('uploads/profiles/' . ($user['profile_image'] ?? 'default.png')) ?>"
        alt="Profile"
        class="rounded-full shadow w-28 h-28 object-cover border border-fuchsia-200 mb-2"
        onerror="this.src='<?= base_url('uploads/profiles/default.png') ?>'"
      >
      <input type="file" name="profile_image" accept="image/*"
        class="block w-full text-sm text-gray-500 border border-fuchsia-200 rounded mt-2 focus:outline-none focus:border-fuchsia-400" />
      <div class="text-xs text-gray-400 mt-1">Ukuran maks 2MB. Kosongkan jika tidak ingin mengubah.</div>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">Username</label>
      <input type="text" name="username" value="<?= old('username', $user['username'] ?? '') ?>"
        class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm" required>
    </div>
    <div>
      <label class="block mb-1 font-medium text-slate-700 text-sm">Password Baru</label>
      <input type="password" name="password" placeholder="Biarkan kosong jika tidak ingin mengubah"
        class="w-full px-3 py-2 border border-fuchsia-200 rounded focus:outline-none focus:border-fuchsia-400 text-sm">
    </div>
    <div class="flex justify-end">
      <button type="submit" class="px-6 py-2 bg-fuchsia-600 text-white rounded-lg shadow font-semibold hover:bg-fuchsia-700 flex items-center gap-2">
        <i class="fa fa-save"></i> Simpan
      </button>
    </div>
  </form>
</div>

<?= $this->endSection() ?>
