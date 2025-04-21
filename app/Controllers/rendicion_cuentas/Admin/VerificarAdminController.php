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
            // Verificar si el token necesita ser actualizado
            $admin = $this->AdministradoresModel
                ->select('estado, categoria_admin')
                ->where('dni_admin', $session->get('dni_admin'))
                ->first();

            if (!$admin || $admin['estado'] === 'deshabilitado') {
                session()->destroy();
                return redirect()->to(RUTA_LOGIN)->with('error', 'Tu sesión ha expirado o tu cuenta ha sido deshabilitada.');
            }

            // Actualizar token si ha pasado más de 30 minutos o si la categoría cambió
            if (time() - $session->get('token_last_updated') > 1800 || $admin['categoria_admin'] !== $session->get('categoria_admin')) {
                $newToken = bin2hex(random_bytes(32));
                $session->set([
                    'auth_token' => $newToken,
                    'token_last_updated' => time(),
                    'categoria_admin' => $admin['categoria_admin'], // Actualizar categoría en la sesión
                ]);

                // Actualizar token en las cookies
                setcookie('auth_token', $newToken, [
                    'expires' => time() + 3600,
                    'path' => '/',
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'Strict',
                ]);
            }

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
            'auth_token' => $token,
            'token_last_updated' => time(),
            'isLoggedIn' => true,
        ]);

        // Guardar token en las cookies
        setcookie('auth_token', $token, [
            'expires' => time() + 3600,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
        ]);

        $nombre = ucfirst(strtolower(explode(' ', trim($admin['nombres_admin']))[0]));
        return redirect()->to(RUTA_ADMIN_HOME)->with('success', 'Bienvenido, ' . $nombre);
    }
    public function logout()
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session()->destroy();
        }
        return redirect()->to(RUTA_LOGIN)->with('success', 'Sesión cerrada correctamente');
    }
}
