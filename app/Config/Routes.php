<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ========================================
// AUTHENTICATION
// ========================================
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// ========================================
// HALAMAN UTAMA & DASHBOARD
// ========================================
$routes->get('/', 'Home::index', ['filter' => 'auth']);
$routes->get('dashboard', 'Home::index', ['filter' => 'auth']);
$routes->get('profile', 'Profile::index', ['filter' => 'auth']);

// ========================================
// MASTER DATA – HANYA SUPERADMIN
// ========================================
$routes->group('master', ['filter' => 'auth'], function($routes) {

    // MASTER USER
    $routes->get('user', 'Master\UserController::index');
    $routes->post('user/store', 'Master\UserController::store');
    $routes->match(['get', 'post', 'patch', 'put'], 'user/update/(:num)', 'Master\UserController::update/$1');
    $routes->get('user/delete/(:num)', 'Master\UserController::delete/$1');

    // MASTER GUDANG
    $routes->get('gudang', 'Master\GudangController::index');
    $routes->post('gudang', 'Master\GudangController::store');
    $routes->match(['post','patch'], 'gudang/update/(:num)', 'Master\GudangController::update/$1');
    $routes->get('gudang/delete/(:num)', 'Master\GudangController::delete/$1');

    // MASTER KATEGORI BARANG
    $routes->get('kategori', 'Master\KategoriController::index');
    $routes->post('kategori', 'Master\KategoriController::store');      
    $routes->match(['post', 'patch'], 'kategori/update/(:num)', 'Master\KategoriController::update/$1');
    $routes->get('kategori/delete/(:num)', 'Master\KategoriController::delete/$1');
    // MASTER BARANG
    $routes->get('barang', 'Master\BarangController::index');
    $routes->post('barang', 'Master\BarangController::store');                    
    $routes->match(['post', 'patch'], 'barang/update/(:num)', 'Master\BarangController::update/$1'); 
    $routes->get('barang/delete/(:num)', 'Master\BarangController::delete/$1');
});

// ========================================
// TRANSAKSI – SESUAI SPEK TUGAS
// ========================================
$routes->group('transaksi', ['filter' => 'auth'], function($routes) {

   // BARANG MASUK (PENERIMAAN)
    $routes->get('penerimaan', 'Transaksi\PenerimaanController::index');
    $routes->get('penerimaan/create', 'Transaksi\PenerimaanController::create');
    $routes->post('penerimaan/store', 'Transaksi\PenerimaanController::store');
    $routes->get('penerimaan/detail/(:num)', 'Transaksi\PenerimaanController::detail/$1');
    $routes->get('penerimaan/approve/(:num)', 'Transaksi\PenerimaanController::approve/$1');   // DIUBAH JADI GET
    $routes->get('penerimaan/delete/(:num)', 'Transaksi\PenerimaanController::delete/$1');

// BARANG KELUAR (SURAT JALAN)
    $routes->get('surat-jalan', 'Transaksi\SuratJalanController::index');
    $routes->get('surat-jalan/create', 'Transaksi\SuratJalanController::create');
    $routes->post('surat-jalan/store', 'Transaksi\SuratJalanController::store');
    $routes->get('surat-jalan/detail/(:num)', 'Transaksi\SuratJalanController::detail/$1');
    $routes->get('surat-jalan/approve/(:num)', 'Transaksi\SuratJalanController::approve/$1'); // DITAMBAHKAN!
    $routes->get('surat-jalan/delete/(:num)', 'Transaksi\SuratJalanController::delete/$1');
});

// ========================================
// LAPORAN (Opsional, tapi bagus ditambah)
// ========================================
$routes->group('laporan', ['filter' => 'auth'], function($routes) {
    $routes->get('stok', 'Laporan\StokController::index');
    $routes->get('barang-masuk', 'Laporan\BarangMasukController::index');
    $routes->get('barang-keluar', 'Laporan\BarangKeluarController::index');
});