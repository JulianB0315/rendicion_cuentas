<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//Rutas de form
$routes->get('form', 'FormController::buscar_rendicion');
$routes->post('procesar_formulario', 'FormController::procesar_formulario');
//Rutas de admin
$routes->get('admin', 'adminController::buscar_eje');
$routes->post('crear_eje', 'adminController::crear_eje');
$routes->post('crear_rendicion', 'adminController::crear_rendicion');
//Rutas Question
$routes->get('questions', 'QuestionsController::index');
//Rutas de api
$routes->get('api/dni/(:num)', 'ConsultaApi::buscarDNI/$1');
$routes->get('api/ruc/(:num)', 'ConsultaApi::buscarRUC/$1');