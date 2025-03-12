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
        $dni_admin = $this->admin->get('dni_admin');
        $nombres = $this->admin->get('nombres_admin');
        $primer_nombre = explode(' ', $nombres)[0];
        $admins = $this->AdministradoresModel
            ->select('dni_admin, nombres_admin, categoria_admin')
            ->where('dni_admin !=', $dni_admin)
            ->where('estado', 'habilitado')
            ->findAll();
        foreach ($admins as &$admin) {
            if ($admin['categoria_admin'] == 'super_admin') {
                $admin['categoria_admin'] = 'S. Admin';
            } elseif ($admin['categoria_admin'] == 'admin') {
                $admin['categoria_admin'] = 'Admin';
            }
        }
        return view('admin_users', ['admins' => $admins, 'nombre' => $primer_nombre]);
    }
    public function crear_admin()
    {
        $dni = $this->request->getGet('dni-admin');
        $nombres = $this->request->getGet('name-admin');
        $password = $this->request->getGet('password');
        $categoria = $this->request->getGet('categoria');
        $estado = 'habilitado';
        if ($this->AdministradoresModel->where('dni_admin', $dni)->first()) {
            return redirect()->back()->with('error', 'El DNI ya está registrado.');
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'dni_admin' => $dni,
            'nombres_admin' => $nombres,
            'password' => $hashedPassword,
            'categoria_admin' => $categoria,
            'estado' => $estado
        ];

        $this->AdministradoresModel->insert($data);
        session()->setFlashdata('success', 'Administrador creado exitosamente');
        return redirect()->to(base_url('admin/admin_users'));
    }
    public function buscar_admin()
    {
        $admin = $this->request->getGet('dni-admin');
        $admin = $this->AdministradoresModel
            ->select('dni_admin, nombres_admin, categoria_admin, estado')
            ->where('dni_admin', $admin)
            ->where('estado', 'deshabilitado')
            ->first();
        if ($admin) {
            if ($admin['categoria_admin'] == 'super_admin') {
                $admin['categoria_admin'] = 'S. Admin';
            } elseif ($admin['categoria_admin'] == 'admin') {
                $admin['categoria_admin'] = 'Admin';
            }
            return $this->response->setJSON([
                'status' => 'success',
                'data' => $admin
            ]);
        }
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'No se encontró el administrador'
        ]);
    }
    public function deshabilitar_admin($admin)
    {
        $motivo = $this->request->getGet('motivo');
        if (empty($motivo)) {
            session()->setFlashdata('error', 'El motivo es requerido');
            return redirect()->back();
        }
        $this->AdministradoresModel
            ->set([
                'estado' => 'deshabilitado',
                'motivo_deshabilitado' => $motivo,
                'fecha_deshabilitado' => date('Y-m-d H:i:s')
            ])
            ->where('dni_admin', $admin)
            ->update();
        session()->setFlashdata('success', 'Administrador deshabilitado exitosamente');
        return redirect()->to(base_url('admin/admin_users'));
    }
    function habilitar_admin($admin)
    {
        $this->AdministradoresModel
            ->set([
                'estado' => 'habilitado',
                'motivo_deshabilitado' => null,
                'fecha_deshabilitado' => null
            ])
            ->where('dni_admin', $admin)
            ->update();
        session()->setFlashdata('success', 'Administrador habilitado exitosamente');
        return redirect()->to(base_url('admin/admin_users'));
    }
    public function editar_admin($admin)
    {
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->AdministradoresModel
            ->set('password', $hashedPassword)
            ->where('dni_admin', $admin)
            ->update();
        return redirect()->to(base_url('admin/admin_users'));
    }
}
