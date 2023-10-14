<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('AdmPanel', ['namespaces' => 'App\Controllers'], function ($routes) {

  $routes->get('/', 'AdmController::index');
});