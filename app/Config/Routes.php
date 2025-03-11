<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//Rutas de login del admin
$routes->get('login', 'Admin_loginController::index');
$routes->post('session', 'Admin_loginController::login');
// $routes->get('insertarAdmin', 'Admin_loginController::insertarAdmin');
$routes->get('logout', 'Admin_loginController::logout');

//Rutas de admin
$routes->group('/admin', ['filter' => 'auth'],function ($routes) {
    //Inicio de admin
    $routes->get('/', 'adminController::buscar_eje');
    $routes->post('crear_eje', 'adminController::crear_eje');
    $routes->post('crear_rendicion', 'adminController::crear_rendicion');
    //Rutas Seleccionar preguntas
    $routes->get('questions', 'QuestionsController::cargar_fechas');
    $routes->get('questions/buscar_rendecion_admin', 'QuestionsController::buscar_rendecion_admin');
    //Rutas Sorteo preguntas (Dentro de selecionar preguntas)
    $routes->get('sorteo_preguntas/(:alphanum)', 'QuestionsController::sorteo_preguntas/$1');
    $routes->post('procesar_seleccion', 'SortController::procesar_seleccion');
    //Rutas Preguntas seleccionadas
    $routes->get('viewQuestions', 'viewQuestionsController::cargar_fechas');
    $routes->get('viewQuestions/buscar_rendecion_admin', 'viewQuestionsController::buscar_rendecion_admin');
    $routes->post('viewQuestions/borrar_pregunta', 'viewQuestionsController::borrar_pregunta');
    //Rutas de reportes
    $routes->get('report', 'ReportController::mostrar_rendiciones');
    $routes->get('mostrar_reporte', 'ReportController::mostrar_reporte');
    //Generacion de excel(Dentro de reportes)
    $routes->get('viewReportController/generar_excel/(:alphanum)', 'viewReportController::generar_excel/$1');
    //Rutas de Super admin
    $routes->group('', ['filter' => 'superAdmin'], function ($routes) {
        //Rutas de administrar usuarios
        $routes->get('admin_users', 'Admin_usersController::index');
        $routes->get('crear_admin', 'Admin_usersController::crear_admin');
        //Rutas Editar admin(Dentro de Super admin)
        $routes->get('deshabilitar_admin/(:alphanum)', 'Admin_usersController::deshabilitar_admin/$1');
        $routes->post('habilitar_admin/(:alphanum)', 'Admin_usersController::habilitar_admin/$1');
        $routes->post('editar_admin/(:alphanum)', 'Admin_usersController::editar_admin/$1');
        $routes->get('buscar_admin/(:alphanum)', 'Admin_usersController::buscar_admin/$1');
    });
});
//Rutas del usuario(Formulario)
$routes->group('form', function ($routes) {
    $routes->get('/', 'FormController::buscar_rendicion');
    $routes->post('procesar_formulario', 'FormController::procesar_formulario');
});
// Rutas de conferencias detalle
$routes->get('conferencias/(:alphanum)', 'ConferenciaController::show/$1');
$routes->get('conferencias/obtenerPreguntas/(:alphanum)/(:alphanum)', 'ConferenciaController::obtenerPreguntas/$1/$2');
// Rutas de asistencia
$routes->get('asistencia', 'AsistenciaController::index');
$routes->post('procesar_asistencia', 'AsistenciaController::procesar_asistencia');
// Rutas de usuarioQuestions
$routes->get('usuarioQuestions', 'usuarioQuestionsController::index');
$routes->get('usuarioQuestions/buscar_rendecion_admin', 'usuarioQuestionsController::buscar_rendecion_admin');
//Rutas de api
$routes->get('api/dni/(:num)', 'ConsultaApi::buscarDNI/$1');
$routes->get('api/ruc/(:num)', 'ConsultaApi::buscarRUC/$1');
//Rutas de la beta
// $routes->post('mostrar_preguntas_seleccionadas/(:alphanum)', 'viewQuestionsController::mostrar_preguntas_seleccionadas/$1');
// $routes->post('borrar_seleccion', 'SelectionController::borrar_seleccion');