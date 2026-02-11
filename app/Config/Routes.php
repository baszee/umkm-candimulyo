<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('get-umkm/(:num)', 'Home::getData/$1');// Rute Login
// Rute Login (Bebas Akses)
$routes->get('login', 'Auth::index');
$routes->post('login/process', 'Auth::loginProcess');
$routes->get('logout', 'Auth::logout');

// Rute Admin (DIJAGA SATPAM 'auth')
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin::index');              // Akses: /admin
    $routes->get('create', 'Admin::create');        // Akses: /admin/create
    $routes->post('save', 'Admin::save');           // Akses: /admin/save
    $routes->get('delete/(:num)', 'Admin::delete/$1'); 
    $routes->get('edit/(:num)', 'Admin::edit/$1');
    $routes->post('update/(:num)', 'Admin::update/$1');
    $routes->get('export', 'Admin::export');

    $routes->get('ganti_password', 'Admin::ganti_password');
    $routes->post('update_password', 'Admin::update_password');
});