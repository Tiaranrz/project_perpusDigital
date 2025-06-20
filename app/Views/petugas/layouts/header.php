<!-- app/Views/layouts/head.php -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('images/LOGO SMK MB.png') ?>" />
    <meta name="csrf-token" content="<?= csrf_hash() ?>">
<meta name="csrf-header" content="<?= csrf_header() ?>">

    <link rel="icon" type="image/png" href="<?= base_url('images/LOGO SMK MB.png') ?>" />
    <title><?= esc($title ?? 'Dashboard Petugas | Perpustakaan Digital') ?></title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="<?= base_url('assets/css/nucleo-icons.css') ?>" rel="stylesheet" />
    <link href="<?= base_url('assets/css/nucleo-svg.css') ?>" rel="stylesheet" />
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link href="<?= base_url('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') ?>" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

</head>
