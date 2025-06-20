<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Auth routes
$routes->get('/', 'Auth::login');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginPost');

$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::registerPost');

$routes->get('/logout', 'Auth::logout');

// Dashboard Routes (dengan filter login)
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);
$routes->get('admin/dashboard', 'Admin\Dashboard::index', ['filter' => 'auth']);
$routes->get('petugas/dashboard', 'Petugas\Dashboard::index', ['filter' => 'auth']);
$routes->get('siswa/landing', 'Siswa\Landing::index', ['filter' => 'auth']);

// Start ROlE ADMIN

// admin/menu manajemen users
$routes->group('admin', function($routes) {
    $routes->get('users/(:segment)',        'Admin\User::index/$1');      // List + Search per role
    $routes->get('users/(:segment)/add',    'Admin\User::add/$1');
    $routes->post('users/(:segment)/save',  'Admin\User::save/$1');
    $routes->get('users/(:segment)/edit/(:num)',   'Admin\User::edit/$1/$2');
    $routes->post('users/(:segment)/update/(:num)','Admin\User::update/$1/$2');
    $routes->get('users/(:segment)/delete/(:num)','Admin\User::delete/$1/$2');
    $routes->get('users/(:segment)/password/(:num)',  'Admin\User::password/$1/$2');
$routes->post('users/(:segment)/password/(:num)', 'Admin\User::password_save/$1/$2');
});

// Admin/Menu manajemen book
$routes->group('admin', function($routes) {
    // Book
    $routes->get('books',                   'Admin\Book::index');
    $routes->get('books/add',               'Admin\Book::add');
    $routes->post('books/save',             'Admin\Book::save');
    $routes->get('books/edit/(:num)',       'Admin\Book::edit/$1');
    $routes->post('books/update/(:num)',    'Admin\Book::update/$1');
    $routes->get('books/delete/(:num)',     'Admin\Book::delete/$1');

    // Category
    $routes->get('categories/add',      'Admin\Category::add');
    $routes->post('categories/save',    'Admin\Category::save');
    $routes->get('categories/edit/(:num)', 'Admin\Category::edit/$1');
    $routes->post('categories/update/(:num)', 'Admin\Category::update/$1');
});

// Admin/menu peminjaman dan pengembalian
$routes->group('admin', function($routes) {
    $routes->get('peminjaman',               'Admin\Peminjaman::index');
    $routes->get('peminjaman/add',           'Admin\Peminjaman::add');
    $routes->post('peminjaman/save',         'Admin\Peminjaman::save');
    $routes->get('peminjaman/approve/(:num)','Admin\Peminjaman::approve/$1');
    $routes->get('peminjaman/reject/(:num)', 'Admin\Peminjaman::reject/$1');
    $routes->get('peminjaman/return/(:num)', 'Admin\Peminjaman::returnForm/$1');
    $routes->post('peminjaman/return/(:num)','Admin\Peminjaman::saveReturn/$1');
    $routes->get('peminjaman/delete/(:num)', 'Admin\Peminjaman::delete/$1');
});

// Admin/menu laporan
$routes->group('admin', function($routes) {
    $routes->get('laporan',             'Admin\Laporan::index');
    $routes->get('laporan/cetak',       'Admin\Laporan::cetak');  // Print / PDF
});

// Admin/Profile
$routes->group('admin', function($routes) {
    $routes->get('profile', 'Admin\Profile::index', ['filter' => 'auth']);
    $routes->post('profile/update', 'Admin\Profile::update', ['filter' => 'auth']);
});

// End ROLE ADMIN


// Start ROLE PETUGAS


// Petugas/Profile
$routes->group('petugas', function($routes) {
    $routes->get('profile', 'Petugas\Profile::index', ['filter' => 'auth']);
    $routes->post('profile/update', 'Petugas\Profile::update', ['filter' => 'auth']);
});

// Petugas/Menu Manajemen Book
$routes->group('petugas', function($routes) {

    $routes->get('books',                     'Petugas\Book::index');
    $routes->get('books/add',                 'Petugas\Book::add');
    $routes->post('books/save',               'Petugas\Book::save');
    $routes->get('books/edit/(:num)',         'Petugas\Book::edit/$1');
    $routes->post('books/update/(:num)',      'Petugas\Book::update/$1');

    // Category 
    $routes->get('categories/add',            'Petugas\Category::add');
    $routes->post('categories/save',          'Petugas\Category::save');
    $routes->get('categories/edit/(:num)',    'Petugas\Category::edit/$1');
    $routes->post('categories/update/(:num)', 'Petugas\Category::update/$1');
});

// Petugas/Menu Peminjaman Buku
$routes->group('petugas', function($routes) {
    $routes->get('peminjaman',                  'Petugas\Peminjaman::index');
    $routes->get('peminjaman/add',              'Petugas\Peminjaman::add');
    $routes->post('peminjaman/save',            'Petugas\Peminjaman::save');
    $routes->get('peminjaman/edit/(:num)',      'Petugas\Peminjaman::edit/$1');
    $routes->post('peminjaman/update/(:num)',   'Petugas\Peminjaman::update/$1');
    $routes->get('peminjaman/approve/(:num)',   'Petugas\Peminjaman::approve/$1');
    $routes->get('peminjaman/reject/(:num)',    'Petugas\Peminjaman::reject/$1');
});

// Petugas/Menu Pengembalian Buku
$routes->group('petugas', function($routes) {
    $routes->get('pengembalian',       'Petugas\Pengembalian::index');
    $routes->get('pengembalian/add',   'Petugas\Pengembalian::add');
    $routes->post('pengembalian/save', 'Petugas\Pengembalian::save');
});

// Petugas/Menu Daftar Anggota
$routes->group('petugas', function($routes) {
    $routes->get('anggota', 'Petugas\Anggota::index');
});

// Petugas/Menu Laporan
$routes->group('petugas', function($routes) {
    $routes->get('laporan', 'Petugas\Laporan::index');
    $routes->get('laporan/print', 'Petugas\Laporan::cetak');
});

// End ROLE PETUGAS


// Start ROLE SISWA

 $routes->group('siswa', function($routes) {
    $routes->get('landing/detail/(:num)',    'Siswa\Landing::detail/$1');
    $routes->get('landing/formPinjam/(:num)', 'Siswa\Landing::formPinjam/$1'); // <-- Tambahkan ini!
    $routes->post('landing/pinjam/(:num)', 'Siswa\Landing::pinjam/$1');
    $routes->get('riwayat',         'Siswa\Landing::riwayat');
    $routes->get('profile', 'Siswa\Profile::index');
    $routes->post('profile/update', 'Siswa\Profile::update');
    $routes->post('profile/password', 'Siswa\Profile::gantiPassword');
    $routes->get('siswa/notifikasi/ajax', 'Siswa\Landing::ajaxNotifikasi');

});


// End ROLE SISWA

















