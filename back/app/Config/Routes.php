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


$routes->get('association', 'Parametre::index');
$routes->get('one_association/(:any)', 'Parametre::show/$1');
$routes->post('new_association', 'Parametre::create');
$routes->post('update_association/(:any)', 'Parametre::update/$1');
$routes->post('uploadPhoto_association/(:any)', 'Parametre::uploadPhoto/$1');
$routes->post('off_association/(:any)', 'Parametre::deseable/$1');
$routes->post('on_association/(:any)', 'Parametre::enable/$1');
$routes->post('delete_association/(:any)', 'Parametre::delete/$1');
$routes->post('addSoldeSms/(:any)', 'Parametre::addSoldeSms/$1');
$routes->post('addSoldeEmail/(:any)', 'Parametre::addSoldeEmail/$1');
$routes->post('addSoldeWhatsapp/(:any)', 'Parametre::addSoldeWhatsapp/$1');
$routes->post('addSoldeTelegram/(:any)', 'Parametre::addSoldeTelegram/$1');





$routes->get('role', 'Role::index');
$routes->get('one_role/(:any)', 'Role::show/$1');
$routes->post('new_role', 'Role::create');
$routes->post('update_role/(:any)', 'Role::update/$1');
$routes->post('off_role/(:any)', 'Role::deseable/$1');
$routes->post('on_role/(:any)', 'Role::enable/$1');
$routes->post('delete_role/(:any)', 'Role::delete/$1');





$routes->get('module', 'Module::index');
$routes->get('one_module/(:any)', 'Module::show/$1');
$routes->post('new_module', 'Module::create');
$routes->post('update_module/(:any)', 'Module::update/$1');
$routes->post('off_module/(:any)', 'Module::deseable/$1');
$routes->post('on_module/(:any)', 'Module::enable/$1');
$routes->post('delete_module/(:any)', 'Module::delete/$1');





$routes->get('permission', 'Permission::index');
$routes->post('off_permission/(:any)', 'Permission::deseable/$1');
$routes->post('on_permission/(:any)', 'Permission::enable/$1');
$routes->post('update_permission/(:any)', 'Permission::update/$1');





$routes->get('utilisateur', 'Utilisateur::index');
$routes->get('utilisateur_actifs', 'Utilisateur::actifs');
$routes->get('one_utilisateur/(:any)', 'Utilisateur::show/$1');
$routes->post('new_utilisateur', 'Utilisateur::create');
$routes->post('update_utilisateur/(:any)', 'Utilisateur::update/$1');
$routes->post('off_utilisateur/(:any)', 'Utilisateur::deseable/$1');
$routes->post('uploadPhoto_utilisateur/(:any)', 'Utilisateur::uploadPhoto/$1');
$routes->post('on_utilisateur/(:any)', 'Utilisateur::enable/$1');
$routes->post('delete_utilisateur/(:any)', 'Utilisateur::delete/$1');





$routes->get('inscription', 'Inscription::index');
$routes->get('one_inscription/(:any)', 'Inscription::show/$1');
$routes->get('one/(:any)', 'Inscription::one/$1');
$routes->get('check_inscription/(:any)', 'Inscription::check/$1');
$routes->post('new_inscription', 'Inscription::create');
$routes->post('update_inscription/(:any)', 'Inscription::update/$1');
$routes->post('off_inscription/(:any)', 'Inscription::deseable/$1');
$routes->post('on_inscription/(:any)', 'Inscription::enable/$1');
$routes->post('delete_inscription/(:any)', 'Inscription::delete/$1');





$routes->get('epargne', 'Epargne::index');
$routes->get('one_epargne/(:any)', 'Epargne::show/$1');
$routes->get('check_inscription/(:any)', 'Epargne::check/$1');
$routes->get('check_this_month/(:any)', 'Epargne::checkMonth/$1');
$routes->get('check_months_interets/(:any)', 'Epargne::checkInterets/$1');
$routes->post('new_epargne', 'Epargne::create');
$routes->post('update_epargne/(:any)', 'Epargne::update/$1');
$routes->post('off_epargne/(:any)', 'Epargne::deseable/$1');
$routes->post('on_epargne/(:any)', 'Epargne::enable/$1');


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