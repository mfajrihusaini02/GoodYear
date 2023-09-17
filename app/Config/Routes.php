<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::dashboard', ['filter' => 'login']);
$routes->post('/dashboard', 'Home::dashboard', ['filter' => 'login']);
$routes->get('/dashboard', 'Home::dashboard', ['filter' => 'login']);
//Daftar Table
$routes->get('/daftar_role', 'DaftarRoleController::index', ['filter' => 'login']);
$routes->get('/daftar_pengguna', 'DaftarPenggunaController::index', ['filter' => 'login']);
$routes->get('/daftar_sertifikat', 'DaftarSertifikatController::index', ['filter' => 'login']);
$routes->get('/daftar_karyawan', 'DaftarKaryawanController::index', ['filter' => 'login']);
$routes->get('/daftar_jabatan', 'DaftarJabatanController::index', ['filter' => 'login']);
$routes->get('/daftar_divisi', 'DaftarDivisiController::index', ['filter' => 'login']);
$routes->get('/karyawan', 'DaftarKaryawanController::index_karyawan', ['filter' => 'login']);
//Daftar Add
$routes->get('/tambah_role', 'DaftarRoleController::tambah_role', ['filter' => 'login']);
$routes->get('/tambah_pengguna', 'DaftarPenggunaController::tambah_pengguna', ['filter' => 'login']);
$routes->get('/tambah_sertifikat', 'DaftarSertifikatController::tambah_sertifikat', ['filter' => 'login']);
$routes->get('/tambah_karyawan', 'DaftarKaryawanController::tambah_karyawan', ['filter' => 'login']);
$routes->get('/tambah_jabatan', 'DaftarJabatanController::tambah_jabatan', ['filter' => 'login']);
$routes->get('/tambah_divisi', 'DaftarDivisiController::tambah_divisi', ['filter' => 'login']);
//Daftar Save
$routes->post('/simpan_role', 'DaftarRoleController::simpan_role', ['filter' => 'login']);
$routes->post('/simpan_pengguna', 'DaftarPenggunaController::simpan_pengguna', ['filter' => 'login']);
$routes->post('/simpan_sertifikat', 'DaftarSertifikatController::simpan_sertifikat', ['filter' => 'login']);
$routes->post('/simpan_karyawan', 'DaftarKaryawanController::simpan_karyawan', ['filter' => 'login']);
$routes->post('/simpan_jabatan', 'DaftarJabatanController::simpan_jabatan', ['filter' => 'login']);
$routes->post('/simpan_divisi', 'DaftarDivisiController::simpan_divisi', ['filter' => 'login']);
$routes->post('/simpan_sertifikatkaryawan', 'TransaksiController::simpan_sertifikatkaryawan', ['filter' => 'login']);
// Daftar Edit
$routes->get('/edit_role/(:num)', 'DaftarRoleController::edit_role/$1', ['filter' => 'login']);
$routes->get('/edit_pengguna/(:num)', 'DaftarPenggunaController::edit_pengguna/$1', ['filter' => 'login']);
$routes->get('/edit_sertifikat/(:num)', 'DaftarSertifikatController::edit_sertifikat/$1', ['filter' => 'login']);
$routes->get('/edit_karyawan/(:num)', 'DaftarKaryawanController::edit_karyawan/$1', ['filter' => 'login']);
$routes->get('/edit_jabatan/(:num)', 'DaftarJabatanController::edit_jabatan/$1', ['filter' => 'login']);
$routes->get('/edit_divisi/(:num)', 'DaftarDivisiController::edit_divisi/$1', ['filter' => 'login']);
$routes->get('/edit_karyawandisable/(:num)', 'DaftarKaryawanController::edit_karyawandisable/$1', ['filter' => 'login']);
// Daftar Update
$routes->put('/update_role/(:num)', 'DaftarRoleController::update_role/$1', ['filter' => 'login']);
$routes->put('/update_pengguna/(:num)', 'DaftarPenggunaController::update_pengguna/$1', ['filter' => 'login']);
$routes->put('/update_sertifikat/(:num)', 'DaftarSertifikatController::update_sertifikat/$1', ['filter' => 'login']);
$routes->put('/update_karyawan/(:num)', 'DaftarKaryawanController::update_karyawan/$1', ['filter' => 'login']);
$routes->put('/update_jabatan/(:num)', 'DaftarJabatanController::update_jabatan/$1', ['filter' => 'login']);
$routes->put('/update_divisi/(:num)', 'DaftarDivisiController::update_divisi/$1', ['filter' => 'login']);
// Daftar Delete
$routes->get('/delete_role/(:num)', 'DaftarRoleController::delete_role/$1', ['filter' => 'login']);
$routes->get('/delete_pengguna/(:num)', 'DaftarPenggunaController::delete_pengguna/$1', ['filter' => 'login']);
$routes->get('/delete_sertifikat/(:num)', 'DaftarSertifikatController::delete_sertifikat/$1', ['filter' => 'login']);
$routes->get('/delete_sertifikatkaryawan/(:num)', 'TransaksiController::delete_sertifikatkaryawan/$1', ['filter' => 'login']);
$routes->get('/delete_karyawan/(:num)', 'DaftarKaryawanController::delete_karyawan/$1', ['filter' => 'login']);
$routes->get('/delete_jabatan/(:num)', 'DaftarJabatanController::delete_jabatan/$1', ['filter' => 'login']);
$routes->get('/delete_divisi/(:num)', 'DaftarDivisiController::delete_divisi/$1', ['filter' => 'login']);
// Lihat Karyawan
$routes->get('/lihat_karyawan/(:num)', 'DaftarKaryawanController::lihat_karyawan/$1', ['filter' => 'login']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
