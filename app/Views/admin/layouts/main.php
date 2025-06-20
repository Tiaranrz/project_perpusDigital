<!DOCTYPE html>
<html lang="en">
<?= $this->include('admin/layouts/header') ?>
<body class="m-0 font-sans text-base antialiased font-normal leading-default bg-gray-50 text-slate-500">
    <?= $this->include('admin/layouts/sidebar') ?>

    <!-- GARI̶S̶ ̶L̶I̶N̶E̶ ̶D̶I̶H̶A̶P̶U̶S̶ -->
    <!-- <div class="fixed top-0 left-[19rem]  h-full w-px bg-gradient-to-b from-fuchsia-400 via-gray-200 to-pink-300 z-40 hidden xl:block"></div> -->

    <main class="ease-soft-in-out xl:ml-[250px] relative min-h-screen rounded-xl transition-all duration-200">
        <?= $this->include('admin/layouts/navbar') ?>
        <div class="w-full px-6 py-6 mx-auto">
            <?= $this->renderSection('content') ?>
            <?= $this->include('admin/layouts/footer') ?>
        </div>
    </main>
    <?= $this->include('admin/layouts/script') ?>
</body>
</html>
