<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('form', 'FormController::index');
$routes->post('procesar_formulario', 'FormController::procesar_formulario');
$routes->get('admin', 'adminController::admin');