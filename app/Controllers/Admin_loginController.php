<?php

namespace App\Controllers;

use App\Models\AdministradoresModel;
class Admin_loginController extends BaseController
{
    private $AdministradoresModel;
    function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
    }
    public function index()
    {
        return view('login_admin');
    }
    public function login()
    {
        $dni = $this->request->getPost('dni');
        $password = $this->request->getPost('password');
        $admin = $this->AdministradoresModel->where('dni_admin', $dni)->first();
        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $this->session->set('admin', $admin);
                $this->session->set('categoria', $admin['categoria_admin']);
                return redirect()->to(base_url('admin'));
            } else {
                return redirect()->to(base_url('login'))->with('mensaje', 'Contraseña incorrecta');
            }
        } else {
            return redirect()->to(base_url('login'))->with('mensaje', 'Usuario no encontrado');
        }
    }
}