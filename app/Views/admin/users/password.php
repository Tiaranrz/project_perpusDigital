<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<!-- Breadcrumb -->
<nav class="flex items-center text-gray-500 text-sm mb-6" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <?php foreach($breadcrumb as $i => $bc): ?>
      <?php if($i < count($breadcrumb)-1): ?>
        <li class="inline-flex items-center">
          <a href="<?= esc($bc['url']) ?>" class="inline-flex items-center text-gray-500 hover:text-fuchsia-600 transition">
            <?= esc($bc['label']) ?>
          </a>
          <i class="fa fa-chevron-right mx-2"></i>
        </li>
      <?php else: ?>
        <li class="inline-flex items-center text-fuchsia-500 font-semibold">
          <?= esc($bc['label']) ?>
        </li>
      <?php endif ?>
    <?php endforeach ?>
  </ol>
</nav>

<div class="max-w-md mx-auto bg-white p-6 md:p-8 rounded-2xl shadow-2xl border border-fuchsia-100 mt-8 mb-6">
  <!-- Judul -->
  <div class="mb-4 flex flex-col items-center">
    <h2 class="text-lg font-bold text-fuchsia-700 flex items-center gap-2 mb-1 text-center">
      <i class="fa fa-key text-xl"></i>
      Ganti Password <span class="text-fuchsia-600">"<?= esc($user['username']) ?>"</span>
    </h2>
    <p class="text-xs text-gray-400">Silakan masukkan password baru yang kuat untuk akun ini.</p>
  </div>

  <?php if(session()->getFlashdata('errors')): ?>
    <div class="mb-5 p-3 rounded-lg bg-red-50 text-red-700 border border-red-200 animate-pulse flex flex-col gap-1 text-sm">
      <?php foreach(session()->getFlashdata('errors') as $error): ?>
        <div><i class="fa fa-times-circle mr-2"></i><?= $error ?></div>
      <?php endforeach ?>
    </div>
  <?php endif ?>

  <form action="<?= esc($form_action) ?>" method="post" class="space-y-5">
    <?= csrf_field() ?>
    <div>
      <label class="block mb-2 font-semibold text-slate-700 flex items-center gap-2 text-sm" for="password">
        <span class="bg-fuchsia-100 rounded-full p-1 flex items-center"><i class="fa fa-lock text-fuchsia-500"></i></span>
        Password Baru
      </label>
      <div class="relative">
        <input id="password" name="password" type="password"
          class="w-full px-4 py-2 border border-fuchsia-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-fuchsia-400 focus:border-fuchsia-400 transition placeholder-slate-400 shadow-sm text-sm pr-10"
          placeholder="Password baru..." required minlength="4" autocomplete="new-password">
        <button type="button" tabindex="-1"
          class="absolute inset-y-0 right-2 flex items-center text-fuchsia-400 hover:text-fuchsia-600"
          onclick="togglePassword('password', this)">
          <i class="fa fa-eye"></i>
        </button>
      </div>
    </div>
    <div>
      <label class="block mb-2 font-semibold text-slate-700 flex items-center gap-2 text-sm" for="confirm_password">
        <span class="bg-fuchsia-100 rounded-full p-1 flex items-center"><i class="fa fa-check-circle text-fuchsia-500"></i></span>
        Konfirmasi Password
      </label>
      <div class="relative">
        <input id="confirm_password" name="confirm_password" type="password"
          class="w-full px-4 py-2 border border-fuchsia-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-fuchsia-400 focus:border-fuchsia-400 transition placeholder-slate-400 shadow-sm text-sm pr-10"
          placeholder="Ulangi password..." required minlength="4" autocomplete="new-password">
        <button type="button" tabindex="-1"
          class="absolute inset-y-0 right-2 flex items-center text-fuchsia-400 hover:text-fuchsia-600"
          onclick="togglePassword('confirm_password', this)">
          <i class="fa fa-eye"></i>
        </button>
      </div>
    </div>
    <div class="flex justify-end gap-2 pt-2">
      <a href="<?= base_url('admin/users/'.$role) ?>"
        class="px-4 py-2 rounded-lg border border-gray-200 bg-gray-50 text-slate-600 hover:bg-gray-100 transition flex items-center gap-1 text-sm font-semibold">
        <i class="fa fa-arrow-left"></i> Batal
      </a>
      <button type="submit"
        class="px-5 py-2 rounded-lg bg-fuchsia-500 text-white font-bold shadow hover:bg-fuchsia-600 transition flex items-center gap-2 text-sm">
        <i class="fa fa-key"></i> Update Password
      </button>
    </div>
  </form>
</div>

<script>
function togglePassword(inputId, btn) {
  const input = document.getElementById(inputId);
  const icon = btn.querySelector('i');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.remove('fa-eye');
    icon.classList.add('fa-eye-slash');
  } else {
    input.type = 'password';
    icon.classList.remove('fa-eye-slash');
    icon.classList.add('fa-eye');
  }
}
</script>
<?= $this->endSection() ?>
