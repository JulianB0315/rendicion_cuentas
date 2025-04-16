<?php

namespace App\Controllers\rendicion_cuentas\Admin;

use App\Controllers\BaseController;
use App\Models\rendicion_cuentas\AdministradoresModel;
use CodeIgniter\I18n\Time;

class VerificarAdminController extends BaseController
{
    private $AdministradoresModel;
    public function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
    }
//Funciones de login
    public function index()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return redirect()->to(RUTA_ADMIN_HOME)->with('success', 'Ya has iniciado sesión');
        }
        return view('rendicion_cuentas/Admin/login_admin');
    }
    public function login()
    {
        $session = session();
        $dni = $this->request->getPost('dni');
        $password = $this->request->getPost('password');
        // Buscar al admin por DNI
        $admin = $this->AdministradoresModel
            ->select('dni_admin, nombres_admin, categoria_admin, password, estado')
            ->where('dni_admin', $dni)
            ->first();
        // Validar existencia del usuario
        if (!$admin) {
            return redirect()->back()->with('error', 'DNI o contraseña incorrectos');
        }
        // Verificar estado
        if ($admin['estado'] === 'deshabilitado') {
            return redirect()->back()->with('error', 'Usuario deshabilitado');
        }
        // Verificar contraseña
        if (!password_verify($password, $admin['password'])) {
            return redirect()->back()->with('error', 'DNI o contraseña incorrectos');
        }

        // Generar token único
        $token = bin2hex(random_bytes(32));

        // Guardar sesión
        $session->set([
            'dni_admin' => $admin['dni_admin'],
            'nombres_admin' => $admin['nombres_admin'],
            'categoria_admin' => $admin['categoria_admin'],
            'estado' => $admin['estado'],
            'isLoggedIn' => true,
        ]);

        // Configurar cookie HttpOnly para el token
        $response = service('response');
        $response->setCookie('auth_token', $token, 3600, [
            'httponly' => true,
            'secure' => true,
            'path' => '/',
            'domain' => '', 
        ]);

        $nombre = ucfirst(strtolower(explode(' ', trim($admin['nombres_admin']))[0]));
        return redirect()->to(RUTA_ADMIN_HOME)->with('success', 'Bienvenido, ' . $nombre);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(RUTA_LOGIN)->with('success', 'Sesión cerrada correctamente');
    }
}
