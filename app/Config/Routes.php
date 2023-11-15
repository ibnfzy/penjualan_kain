<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('daily-cj', function () {
  $db = \Config\Database::connect();

  $db->table('transaksi')->where('batas_pembayaran <', date('Y-m-d'))->where('bukti_bayar', null)->update([
    'status_transaksi' => 'GAGAL'
  ]);
});

$routes->get('Katalog', 'Home::katalog');
$routes->get('Katalog/(:num)', 'Home::detail/$1');

$routes->post('Search', 'Home::search');

$routes->get('Cart', 'Home::cart');
$routes->get('Cart/Delete/(:segment)', 'Home::remove_barang/$1');
$routes->get('Cart/Clear', 'Home::clear_cart');
$routes->post('Cart/Update', 'Home::update_cart');
$routes->post('Cart/Add', 'Home::add_barang');

$routes->get('Adm/Login', 'AdminLogin::index');
$routes->get('Adm/Logout', 'AdminLogin::logoff');
$routes->post('Adm/Login', 'AdminLogin::auth');

$routes->get('Own/Login', 'OwnLogin::index');
$routes->get('Own/Logout', 'OwnLogin::logoff');
$routes->post('Own/Login', 'OwnLogin::auth');

$routes->get('Login', 'UserLogin::index');
$routes->post('Login', 'UserLogin::auth');
$routes->get('Daftar', 'UserLogin::signup');
$routes->post('Daftar', 'UserLogin::save_data');
$routes->get('Logout', 'UserLogin::logoff');

$routes->group('AdmPanel', ['namespaces' => 'App\Controllers'], function (RouteCollection $routes) {

  $routes->get('/', 'AdmController::index');
  $routes->post('UpadateInformasi', 'AdmController::informasiToko');
  $routes->post('UpadateTentang', 'AdmController::tentangToko');
  $routes->get('Transaksi', 'AdmController::transaksi');
  $routes->get('Transaksi/(:segment)/(:segment)', 'AdmController::invoice/$1/$2');
  $routes->get('Validasi/(:num)', 'AdmController::validasi/$1');
  $routes->get('Kirim/(:num)', 'AdmController::kirim/$1');
  $routes->get('Customer', 'AdmController::customer');
  $routes->get('LaporanTransaksi', 'AdmController::laporan_transaksi');
  $routes->post('LaporanTransaksi/render', 'AdmController::render_laporan_transaksi');
  $routes->get('Hapus/(:num)', 'AdmController::hapus_transaksi/$1');

  $routes->get('Ongkir', 'Ongkir::index');
  $routes->get('Ongkir/(:num)', 'Ongkir::delete/$1');
  $routes->post('Ongkir', 'Ongkir::create');
  $routes->post('Ongkir/Edit', 'Ongkir::update');

  $routes->get('Produk', 'Produk::index');
  $routes->get('Produk/Tambah', 'Produk::new');
  $routes->post('Produk/Tambah', 'Produk::create');
  $routes->post('Produk/Tambah/Varian', 'Produk::tambah_varian');
  $routes->get('Produk/Hapus/(:num)', 'Produk::delete/$1');
  $routes->get('Produk/Detail/(:num)', 'Produk::getDetail/$1');
  $routes->get('Produk/(:num)', 'Produk::edit/$1');
  $routes->post('Produk/(:num)', 'Produk::update/$1');
  $routes->post('Produk/Single', 'Produk::singleInsert');

  $routes->get('Corousel', 'Corousel::index');
  $routes->post('Corousel', 'Corousel::create');
  $routes->get('Corousel/(:num)', 'Corousel::delete/$1');
});

$routes->group('Panel', ['namespace' => 'App\Controllers'], function (RouteCollection $routes) {

  $routes->get('/', 'UserController::index');

  $routes->get('Hapus/(:num)', 'UserController::hapus_transaksi/$1');

  $routes->post('UpdatePassword', 'UserController::updatePassword');
  $routes->post('UpdateInformasi', 'UserController::updateInformasi');

  $routes->get('Cart/Simpan', 'UserController::simpan_keranjang');
  $routes->get('Cart', 'UserController::keranjang');
  $routes->get('Cart/Delete/(:num)', 'UserController::hapus_keranjang');
  $routes->get('Cart/(:segment)', 'UserController::proses_keranjang/$1');

  $routes->get('Transaksi', 'UserController::transaksi');
  $routes->get('Transaksi/(:num)', 'UserController::invoice/$1');
  $routes->post('Transaksi/(:num)', 'UserController::upload_bukti/$1');
  $routes->get('Konfirmasi/(:num)', 'UserController::konfirmasi_pesanan/$1');

  $routes->get('Checkout', 'UserController::checkout');

  $routes->get('Testimoni', 'UserController::testimoni');
  $routes->post('Testimoni', 'UserController::testimoni_save');
  $routes->post('Testimoni/(:num)', 'UserController::testimoni_edit/$1');
});

$routes->group('OwnPanel', ['namespace' => 'App\Controllers'], function (RouteCollection $routes) {
  $routes->get('/', 'OwnController::index');
  $routes->get('Customer', 'OwnController::customer');
  $routes->post('render', 'OwnController::render_laporan_transaksi');
  $routes->get('Testimoni', 'OwnController::testimoni');

});