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
$routes->get('questions', 'QuestionsController::cargar_fechas');
$routes->post('questions/buscar_rendecion_admin', 'QuestionsController::buscar_rendecion_admin');
$routes->post('sorteo_preguntas/(:alphanum)', 'QuestionsController::sorteo_preguntas/$1');
//Rutas Sort
$routes->post('procesar_seleccion', 'SortController::procesar_seleccion');
//Rutas de mostrar preguntas seleccionadas
$routes->get('viewQuestions', 'viewQuestionsController::cargar_fechas');
$routes->post('viewQuestions/buscar_rendecion_admin', 'viewQuestionsController::buscar_rendecion_admin');
$routes->post('mostrar_preguntas_seleccionadas/(:alphanum)', 'viewQuestionsController::mostrar_preguntas_seleccionadas/$1');
//Rutas de api
$routes->get('api/dni/(:num)', 'ConsultaApi::buscarDNI/$1');
$routes->get('api/ruc/(:num)', 'ConsultaApi::buscarRUC/$1');
// Rutas de conferencias detalle
$routes->get('conferencias/(:alphanum)', 'ConferenciaController::show/$1');
$routes->get('asistencia', 'AsistenciaController::index');
$routes->post('procesar_asistencia', 'AsistenciaController::procesar_asistencia');
