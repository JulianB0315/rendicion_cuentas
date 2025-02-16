<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//Rutas de form
$routes->get('form', 'FormController::index');
$routes->post('procesar_formulario', 'FormController::procesar_formulario');
//Rutas de admin
$routes->get('admin', 'adminController::buscar_eje');
$routes->post('crear_eje', 'adminController::crear_eje');
//Rutas de api
$routes->get('api/dni/(:num)', 'ConsultaApi::buscarDNI/$1');
$routes->get('api/ruc/(:num)', 'ConsultaApi::buscarRUC/$1');