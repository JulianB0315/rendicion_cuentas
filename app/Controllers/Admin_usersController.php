<?php

namespace App\Controllers;

use App\Models\AdministradoresModel;

class Admin_UsersController extends BaseController
{
    private $AdministradoresModel;
    private $admin;

    function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
        $this->admin = \Config\Services::session();
    }
    public function index()
    {
        $dni_admin =$this->admin->get('dni_admin');
        $nombres = $this->admin->get('nombres_admin');
        $primer_nombre = explode(' ', $nombres)[0];
        $admins = $this->AdministradoresModel
        ->select('dni_admin, nombres_admin, categoria_admin')
        ->where('dni_admin !=', $dni_admin)
        ->findAll();
        foreach ($admins as &$admin) {
            if ($admin['categoria_admin'] == 'super_admin') {
                $admin['categoria_admin'] = 'S. Admin';
            } elseif ($admin['categoria_admin'] == 'admin') {
                $admin['categoria_admin'] = 'Admin';
            }
        }
        return view('admin_users', ['admins' => $admins,'nombre' => $primer_nombre]);
    }
    public function crear_admin(){
        $dni = $this->request->getGet('dni-admin');
        $nombres = $this->request->getGet('name-admin');
        $password = $this->request->getGet('password');
        $categoria = $this->request->getGet('categoria');

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
    public function borrar_admin($admin){
        $this->AdministradoresModel
        ->where('dni_admin', $admin)
        ->delete();
        return redirect()->to(base_url('admin/admin_users'));
    }
    public function editar_admin($admin){
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->AdministradoresModel
        ->set('password', $hashedPassword)
        ->where('dni_admin', $admin)
        ->update();
        return redirect()->to(base_url('admin/admin_users'));
    }
}
