<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('form', 'FormController::index');
$routes->post('procesar-formulario', 'Form::procesar');