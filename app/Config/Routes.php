<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Rute untuk halaman Admin
// Rute Admin
$routes->get('admin', 'Admin::index');          // Halaman Tabel
$routes->get('admin/create', 'Admin::create');  // Halaman Form Input
$routes->post('admin/save', 'Admin::save');     // Proses Simpan (POST)
