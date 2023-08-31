<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');





$routes->get('module', 'Module::index');
$routes->get('one_module/(:any)', 'Module::show/$1');
$routes->post('new_module', 'Module::create');
$routes->post('update_module/(:any)', 'Module::update/$1');
$routes->post('off_module/(:any)', 'Module::deseable/$1');
$routes->post('on_module/(:any)', 'Module::enable/$1');
$routes->post('delete_module/(:any)', 'Module::delete/$1');





$routes->get('role', 'Role::index');
$routes->get('one_role/(:any)', 'Role::show/$1');
$routes->post('new_role', 'Role::create');
$routes->post('update_role/(:any)', 'Role::update/$1');
$routes->post('off_role/(:any)', 'Role::deseable/$1');
$routes->post('on_role/(:any)', 'Role::enable/$1');
$routes->post('delete_role/(:any)', 'Role::delete/$1');





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





$routes->get('permission', 'Permission::index');
$routes->post('off_permission/(:any)', 'Permission::deseable/$1');
$routes->post('on_permission/(:any)', 'Permission::enable/$1');
$routes->post('update_permission/(:any)', 'Permission::update/$1');
