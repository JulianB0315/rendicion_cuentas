<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdministradoresModel;

Class VerificarAdminController extends BaseController
{
    private $AdministradoresModel;
    public function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
    }

    public function index()
    {
        $session = session();
        if ($session->get('isLoggedIn')) {
            return redirect()->to(base_url('admin'));
        }
        return view('login_admin');
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
        // Guardar sesión
        $session->set([
            'dni_admin' => $admin['dni_admin'],
            'nombres_admin' => $admin['nombres_admin'],
            'categoria_admin' => $admin['categoria_admin'],
            'isLoggedIn' => true,
        ]);
        $nombre = ucfirst(strtolower(explode(' ', trim($admin['nombres_admin']))[0]));
        return redirect(RUTA_LOGIN)->with('success', 'Bienvenido, ' . $nombre);
    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(RUTA_LOGIN);
    }
}
