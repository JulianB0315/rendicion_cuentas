<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2_592_000);
defined('YEAR')   || define('YEAR', 31_536_000);
defined('DECADE') || define('DECADE', 315_360_000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);        // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);          // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);         // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);   // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);  // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);     // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);       // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);      // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); 

// Base URL
define('BASE_URL', 'http://localhost/rendicion_cuentas/');
// Base URL for assets
define('BASE_URL_ASSETS', BASE_URL . 'rendicion_cuentas/');

// General Routes
define('RUTA_HOME', BASE_URL);
define('RUTA_LOGIN', BASE_URL . 'login');
define('RUTA_LOGOUT', BASE_URL . 'logout');
define('RUTA_SESSION', BASE_URL . 'session');

// Admin Routes
define('RUTA_ADMIN_HOME', BASE_URL . 'admin');
define('RUTA_ADMIN_BUSCAR_EDIT', BASE_URL . 'admin/buscar_edit');
define('RUTA_ADMIN_BUSCAR_RENDICION', BASE_URL . 'admin/buscar/'); // Add ID
define('RUTA_ADMIN_BUSCAR_RENDICION_Q', BASE_URL . 'admin/questions/buscar_rendecion_admin');
define('RUTA_ADMIN_BUSCAR_RENDICION_VQ', BASE_URL . 'admin/viewQuestions/buscar_rendecion_admin');
define('RUTA_ADMIN_BORRAR_PREGUNTA', BASE_URL . 'admin/viewQuestions/borrar_pregunta');
define('RUTA_ADMIN_CREAR_EJE', BASE_URL . 'admin/crear_eje');
define('RUTA_ADMIN_EDITAR_EJE', BASE_URL . 'admin/editar_eje');
define('RUTA_ADMIN_CREAR_RENDICION', BASE_URL . 'admin/crear_rendicion');
define('RUTA_ADMIN_EDITAR_RENDICION', BASE_URL . 'admin/editar_rendicion');
define('RUTA_ADMIN_MOSTRAR_REPORTE', BASE_URL . 'admin/mostrar_reporte');
define('RUTA_ADMIN_PROCESAR_SELECCION', BASE_URL . 'admin/procesar_seleccion');
define('RUTA_ADMIN_SORTEO_PREGUNTAS', BASE_URL . 'admin/sorteo_preguntas/'); // Add ID
define('RUTA_ADMIN_GESTION_EJES', BASE_URL . 'admin/gestion_eje');
define('RUTA_ADMIN_SELECCIONAR_PREGUNTAS', BASE_URL . 'admin/seleccionar_preguntas');
define('RUTA_ADMIN_VER_PREGUNTAS', BASE_URL . 'admin/ver_preguntas');

// Super Admin Routes
define('RUTA_ADMIN_CREAR_ADMIN', BASE_URL . 'admin/crear_admin');
define('RUTA_ADMIN_EDITAR', BASE_URL . 'admin/UpdateAdmin/'); // Add ID
define('RUTA_ADMIN_HISTORIAL', BASE_URL . 'admin/historial');
define('RUTA_ADMIN_USERS', BASE_URL . 'admin/admin_users');
define('RUTA_ADMIN_BUSCAR_ADMIN', BASE_URL . 'admin/buscar_admin');

// User (Formulario) Routes
define('RUTA_FORM', BASE_URL . 'form');
define('RUTA_PROCESAR_FORM', BASE_URL . 'form/procesar_formulario');

// Conferencias Routes
define('RUTA_CONFERENCIA_DETALLE', BASE_URL . 'conferencias/'); // Add ID
define('RUTA_CONFERENCIA_PREGUNTAS', BASE_URL . 'conferencias/obtenerPreguntas/'); // Add ID + RENDICION

// Asistencia Routes
define('RUTA_ASISTENCIA', BASE_URL . 'asistencia');
define('RUTA_PROCESAR_ASISTENCIA', BASE_URL . 'procesar_asistencia');

// Usuario Questions Routes
define('RUTA_USUARIO_QUESTIONS', BASE_URL . 'usuarioQuestions');
define('RUTA_BUSCAR_RENDICION_UQ', BASE_URL . 'usuarioQuestions/buscar_rendecion_admin');

// API Routes
define('RUTA_API_DNI', BASE_URL . 'api/dni/'); // Add number
define('RUTA_API_RUC', BASE_URL . 'api/ruc/'); // Add number

// Reportes
define('RUTA_GENERAR_EXCEL', BASE_URL . 'admin/viewReportController/generar_excel/'); // Add ID

// Archivos Públicos
define('RUTA_PUBLIC_JS', BASE_URL_ASSETS . 'js/');
define('RUTA_PUBLIC_CSS', BASE_URL_ASSETS . 'styles/');
define('RUTA_PUBLIC_IMG', BASE_URL_ASSETS . 'img/');
// Archivos JavaScript
define('RUTA_JS_ADMIN', RUTA_PUBLIC_JS . 'admin/');
define('RUTA_JS_CLIENT', RUTA_PUBLIC_JS . 'client/');
define('RUTA_JS_HELPERS', RUTA_PUBLIC_JS . 'helpers/');
define('RUTA_JS_PUBLIC', RUTA_PUBLIC_JS . 'public/');
// Archivos CSS
define('RUTA_CSS_ADMIN', RUTA_PUBLIC_CSS . 'admin/');
define('RUTA_CSS_CLIENT', RUTA_PUBLIC_CSS . 'client/');

