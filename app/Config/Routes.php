<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('Katalog', 'Home::katalog');
$routes->get('Katalog/(:num)', 'Home::detail/$1');

$routes->post('Search', 'Home::search');

$routes->get('Cart', 'Home::cart');
$routes->get('Cart/Delete/(:segment)', 'Home::remove_barang/$1');
$routes->get('Cart/Clear', 'Home::clear_cart');
$routes->post('Cart/Update', 'Home::update_cart');
$routes->post('Cart/Add', 'Home::add_barang');

$routes->get('Adm/Login', 'AdminLogin::index');
$routes->post('Adm/Login', 'AdminLogin::auth');

$routes->get('Login', 'UserLogin::index');
$routes->post('Login', 'UserLogin::auth');
$routes->get('Daftar', 'UserLogin::signup');
$routes->post('Daftar', 'UserLogin::save');

$routes->group('AdmPanel', ['namespaces' => 'App\Controllers'], function ($routes) {

  $routes->get('/', 'AdmController::index');
  $routes->get('Transkasi', 'AdmController::transaksi');
  $routes->get('Customer', 'AdmController::customer');

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

$routes->group('Panel', ['namespace' => 'App\Controllers'], function ($routes) {

  $routes->get('/', 'UserController::index');


});