<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'rendicion_cuentas\Client\DasboardUserController::index');
//Rutas de login del admin
$routes->get('login', 'rendicion_cuentas\Admin\VerificarAdminController::index');
$routes->post('session', 'rendicion_cuentas\Admin\VerificarAdminController::login');
$routes->get('logout', 'rendicion_cuentas\Admin\VerificarAdminController::logout');

//Rutas de admin
$routes->group('/admin', ['filter' => 'auth'], function ($routes) {
    //Inicio de admin
    $routes->get('/', 'rendicion_cuentas\Admin\GestionAdminController::buscarEjes');
    $routes->post('crear_rendicion', 'rendicion_cuentas\Admin\GestionAdminController::CrearRendicion');
    //Gestion de ejes
    $routes->get('gestion_eje', 'rendicion_cuentas\Admin\GestionAdminController::Ejes');
    $routes->post('crear_eje', 'rendicion_cuentas\Admin\GestionAdminController::CrearEje');
    $routes->post('editar_eje', 'rendicion_cuentas\Admin\GestionAdminController::EditarEje');
    //Rutas buscar rendicion
    $routes->get('buscar/(:alphanum)', 'rendicion_cuentas\Admin\GestionAdminController::cargarFechas/$1');
    //Rutas Seleccionar preguntas
    $routes->get('questions/buscar_rendecion_admin', 'rendicion_cuentas\Admin\GestionAdminController::BuscarRendicion');
    //Rutas Sorteo preguntas (Dentro de selecionar preguntas)
    $routes->get('sorteo_preguntas/(:alphanum)', 'rendicion_cuentas\Admin\GestionAdminController::BuscarPreguntas/$1');
    $routes->post('procesar_seleccion', 'rendicion_cuentas\Admin\GestionAdminController::SeleccionarPreguntas');
    //Rutas Preguntas seleccionadas
    $routes->get('viewQuestions/buscar_rendecion_admin', 'rendicion_cuentas\Admin\GestionAdminController::preguntasSeleccionadas');
    $routes->post('viewQuestions/borrar_pregunta', 'rendicion_cuentas\Admin\GestionAdminController::QuitarPregunta');
    // RUTA PARA PRESENTACIÓN DE PREGUNTAS, CAMBIAR RUTA
    $routes->get('presentarPreguntas/(:alphanum)', 'rendicion_cuentas\Admin\GestionAdminController::presentarPreguntas/$1');
    //Rutas de reportes
    $routes->get('mostrar_reporte', 'rendicion_cuentas\Admin\GestionAdminController::MostrarReporte');
    //Generacion de excel(Dentro de reportes)
    $routes->get('viewReportController/generar_excel/(:alphanum)', 'rendicion_cuentas\Admin\GestionAdminController::GenerarExcel/$1');
    //Rutas de editar rendicion
    $routes->post('editar_rendicion', 'rendicion_cuentas\Admin\GestionAdminController::EditarRendicion');
    $routes->get('buscar_edit', 'rendicion_cuentas\Admin\GestionAdminController::BuscarEdit');
    //Rutas de Super admin
    $routes->group('', ['filter' => 'superAdmin'], function ($routes) {
        //Rutas de administrar usuarios
        $routes->get('admin_users', 'rendicion_cuentas\Admin\GestionSuperAdminController::ValidarAdmin');
        $routes->get('crear_admin', 'rendicion_cuentas\Admin\GestionSuperAdminController::CrearAdmin');
        //Rutas Editar admin(Dentro de Super admin)
        $routes->get('buscar_admin', 'rendicion_cuentas\Admin\GestionSuperAdminController::BuscarAdmin');
        $routes->get('UpdateAdmin/(:alphanum)', 'rendicion_cuentas\Admin\GestionSuperAdminController::UpdateAdmin/$1');
        $routes->get('historial', 'rendicion_cuentas\Admin\GestionSuperAdminController::History');
    });
    //Rutas Editar rendicion
});
//Rutas del usuario(Formulario)
$routes->group('form', function ($routes) {
    $routes->get('/', 'rendicion_cuentas\Client\FormularioUserController::BuscarRendicion');
    $routes->post('procesar_formulario', 'rendicion_cuentas\Client\FormularioUserController::ProcesarFormulario');
});
// Rutas de conferencias detalle
$routes->get('conferencias/(:alphanum)', 'rendicion_cuentas\Client\DasboardUserController::Conferencia/$1');
$routes->get('conferencias/obtenerPreguntas/(:alphanum)/(:alphanum)', 'rendicion_cuentas\Client\DasboardUserController::obtenerPreguntas/$1/$2');
// Rutas de asistencia
$routes->get('asistencia', 'rendicion_cuentas\Client\AsistenciaController::index');
$routes->post('procesar_asistencia', 'rendicion_cuentas\Client\AsistenciaController::procesar_asistencia');
// Rutas de usuarioQuestions
$routes->get('usuarioQuestions', 'rendicion_cuentas\Client\DasboardUserController::Report');
$routes->get('usuarioQuestions/buscar_rendecion_admin', 'rendicion_cuentas\Client\DasboardUserController::DatosRendicion');
//Rutas de api
$routes->get('api/dni/(:num)', 'rendicion_cuentas\ConsultaApi::buscarDNI/$1');
$routes->get('api/ruc/(:num)', 'rendicion_cuentas\ConsultaApi::buscarRUC/$1');
//Rutas de la beta
// $routes->post('mostrar_preguntas_seleccionadas/(:alphanum)', 'viewQuestionsController::mostrar_preguntas_seleccionadas/$1');
// $routes->post('borrar_seleccion', 'SelectionController::borrar_seleccion');
// $routes->get('insertarAdmin', 'Admin_loginController::insertarAdmin');