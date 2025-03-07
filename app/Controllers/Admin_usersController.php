<?php

namespace App\Controllers;

use App\Models\AdministradoresModel;

class Admin_UsersController extends BaseController
{
    private $AdministradoresModel;
    function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
    }
    public function index()
    {
        $admins = $this->AdministradoresModel->select('dni_admin, nombres_admin, categoria_admin')->where('categoria_admin', 'admin')->findAll();
        return view('admin_users', ['admins' => $admins]);
    }
    public function crear_admin(){
        $dni = $this->request->getPost('dni-admin');
        $nombres = $this->request->getPost('name-admin');
        $password = $this->request->getPost('password');
        $categoria = 'admin';

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'dni_admin' => $dni,
            'nombres_admin' => $nombres,
            'password' => $hashedPassword,
            'categoria_admin' => $categoria,
        ];

        $this->AdministradoresModel->insert($data);
        return redirect()->to(base_url('admin/admin_users'));
    }
}
