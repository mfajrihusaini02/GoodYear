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
$routes->get('/', 'Home::index', ['filter' => 'login']);
$routes->post('/dashboard', 'Home::dashboard');
$routes->get('/dashboard', 'Home::dashboard');
//Daftar Table
$routes->get('/daftar_role', 'DaftarRoleController::index');
$routes->get('/daftar_pengguna', 'DaftarPenggunaController::index');
$routes->get('/daftar_sertifikat', 'DaftarSertifikatController::index');
$routes->get('/daftar_karyawan', 'DaftarKaryawanController::index');
//Daftar Add
$routes->get('/tambah_role', 'DaftarRoleController::tambah_role');
$routes->get('/tambah_pengguna', 'DaftarPenggunaController::tambah_pengguna');
$routes->get('/tambah_sertifikat', 'DaftarSertifikatController::tambah_sertifikat');
$routes->get('/tambah_karyawan', 'DaftarKaryawanController::tambah_karyawan');
//Daftar Save
$routes->post('/tambah_role/save_role', 'DaftarRoleController::save_role');

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
