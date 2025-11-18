<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman Utama (Dashboard)
$routes->get('/', 'Home::index');

// Route untuk Tambah Barang
// Kita samakan dengan action di form dashboard: 'home/tambahBarang'
$routes->post('home/tambahBarang', 'Home::tambahBarang');

// Route untuk Halaman Transaksi
$routes->get('transaksi', 'Transaksi::index');

// Route untuk Simpan Transaksi
// Pastikan ini cocok dengan action di form_transaksi.php
$routes->post('transaksi/simpan', 'Transaksi::simpan');