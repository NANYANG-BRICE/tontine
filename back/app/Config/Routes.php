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
