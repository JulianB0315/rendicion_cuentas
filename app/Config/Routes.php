<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Client\DasboardUserController::index');
//Rutas de login del admin
$routes->get('login', 'Admin\VerificarAdminController::index');
$routes->post('session', 'Admin\VerificarAdminController::login');
$routes->get('logout', 'Admin\VerificarAdminController::logout');

//Rutas de admin
$routes->group('/admin', ['filter' => 'auth'], function ($routes) {
    //Inicio de admin
    $routes->get('/', 'Admin\GestionAdminController::buscarEjes');
    $routes->post('crear_eje', 'Admin\GestionAdminController::CrearEje');
    $routes->post('crear_rendicion', 'Admin\GestionAdminController::CrearRendicion');
    //Rutas Seleccionar preguntas
    $routes->get('questions/(:alphanum)', 'Admin\GestionAdminController::cargarFechas/$1');
    $routes->get('questions/buscar_rendecion_admin', 'Admin\GestionAdminController::BuscarRendicion');
    //Rutas Sorteo preguntas (Dentro de selecionar preguntas)
    $routes->get('sorteo_preguntas/(:alphanum)', 'Admin\GestionAdminController::BuscarPreguntas/$1');
    $routes->post('procesar_seleccion', 'Admin\GestionAdminController::SeleccionarPreguntas');
    //Rutas Preguntas seleccionadas
    $routes->get('viewQuestions/(:alphanum)', 'Admin\GestionAdminController::cargarFechas/$1');
    $routes->get('viewQuestions/buscar_rendecion_admin', 'Admin\GestionAdminController::preguntasSeleccionadas');
    $routes->post('viewQuestions/borrar_pregunta', 'Admin\GestionAdminController::QuitarPregunta');
    //Rutas de reportes
    $routes->get('report/(:alphanum)', 'Admin\GestionAdminController::cargarFechas/$1');
    $routes->get('mostrar_reporte', 'Admin\GestionAdminController::MostrarReporte');
    //Generacion de excel(Dentro de reportes)
    $routes->get('viewReportController/generar_excel/(:alphanum)', 'Admin\GestionAdminController::GenerarExcel/$1');
    //Rutas de Super admin
    $routes->group('', ['filter' => 'superAdmin'], function ($routes) {
        //Rutas de administrar usuarios
        $routes->get('admin_users', 'Admin\GestionSuperAdminController::ValidarAdmin');
        $routes->get('crear_admin', 'Admin\GestionSuperAdminController::CrearAdmin');
        //Rutas Editar admin(Dentro de Super admin)
        $routes->get('buscar_admin', 'Admin\GestionSuperAdminController::BuscarAdmin');
        $routes->get('UpdateAdmin/(:alphanum)', 'Admin\GestionSuperAdminController::UpdateAdmin/$1');
        $routes->get('historial', 'Admin\GestionSuperAdminController::History');
    });
});
//Rutas del usuario(Formulario)
$routes->group('form', function ($routes) {
    $routes->get('/', 'Client\FormularioUser::BuscarRendicion');
    $routes->post('procesar_formulario', 'Client\FormularioUser::ProcesarFormulario');
});
// Rutas de conferencias detalle
$routes->get('conferencias/(:alphanum)', 'Client\DasboardUserController::Conferencia/$1');
$routes->get('conferencias/obtenerPreguntas/(:alphanum)/(:alphanum)', 'Client\DasboardUserController::obtenerPreguntas/$1/$2');
// Rutas de asistencia
$routes->get('asistencia', 'Client\::');
$routes->post('procesar_asistencia', 'AsistenciaController::procesar_asistencia');
// Rutas de usuarioQuestions
$routes->get('usuarioQuestions', 'Client\DasboardUserController::Report');
$routes->get('usuarioQuestions/buscar_rendecion_admin', 'Client\DasboardUserController::DatosRendicion');
//Rutas de api
$routes->get('api/dni/(:num)', 'ConsultaApi::buscarDNI/$1');
$routes->get('api/ruc/(:num)', 'ConsultaApi::buscarRUC/$1');
//Rutas de la beta
// $routes->post('mostrar_preguntas_seleccionadas/(:alphanum)', 'viewQuestionsController::mostrar_preguntas_seleccionadas/$1');
// $routes->post('borrar_seleccion', 'SelectionController::borrar_seleccion');
// $routes->get('insertarAdmin', 'Admin_loginController::insertarAdmin');