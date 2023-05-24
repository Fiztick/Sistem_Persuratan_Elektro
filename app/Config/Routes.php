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
$routes->setAutoRoute(true);
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

 // Buat bikin database make migration
$routes->get('create-db', function() {
    $forge = \Config\Database::forge();

    if ($forge->createDatabase('db_spe')) {
        echo 'Database created!';
    }
});

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->addRedirect('/', 'home');

$routes->get('inbox', 'Inbox::index');
$routes->put('inbox/(:any)', 'Inbox::update/$1');
$routes->delete('inbox/(:segment)', 'Inbox::destroy/$1');

$routes->get('mailbox', 'Mailbox::index');
$routes->put('mailbox/(:any)', 'Mailbox::update/$1');
$routes->delete('mailbox/(:segment)', 'Mailbox::destroy/$1');

$routes->get('user', 'User::index');
$routes->get('user/add', 'User::create');
$routes->post('user', 'User::store');
$routes->get('user/edit/(:any)', 'User::edit/$1');
$routes->put('user/(:any)', 'User::update/$1');
$routes->delete('user/(:segment)', 'User::destroy/$1');

$routes->get('inventory', 'Inventory::index');
$routes->get('inventory/add', 'Inventory::create');
$routes->post('inventory', 'Inventory::store');
$routes->get('inventory/edit/(:any)', 'Inventory::edit/$1');
$routes->put('inventory/update/(:any)', 'Inventory::update/$1');
$routes->delete('inventory/(:segment)', 'Inventory::destroy/$1');

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
