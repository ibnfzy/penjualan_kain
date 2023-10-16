<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('Adm/Login', 'AdminLogin::index');
$routes->post('Adm/Login', 'AdminLogin::auth');

$routes->get('Login', 'UserLogin::index');
$routes->post('Login', 'UserLogin::auth');
$routes->get('Daftar', 'UserLogin::signup');
$routes->post('Daftar', 'UserLogin::save');

$routes->group('AdmPanel', ['namespaces' => 'App\Controllers'], function ($routes) {

  $routes->get('/', 'AdmController::index');

  $routes->get('Produk', 'Produk::index');
  $routes->get('Produk/Tambah', 'Produk::new');
  $routes->post('Produk/Tambah', 'Produk::create');
  $routes->post('Produk/Tambah/Varian', 'Produk::tambah_varian');
  $routes->get('Produk/Hapus/(:num)', 'Produk::delete/$1');
  $routes->get('Produk/Detail/(:num)', 'Produk::getDetail/$1');
  $routes->get('Produk/(:num)', 'Produk::edit/$1');
  $routes->post('Produk/(:num)', 'Produk::update/$1');

});

$routes->group('Panel', ['namespace' => 'App\Controllers'], function ($routes) {

  $routes->get('/', 'UserController::index');


});