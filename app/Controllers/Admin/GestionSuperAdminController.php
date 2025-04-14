<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdministradoresModel;
use App\Models\HistorialAdminModel;

class GestionSuperAdminController extends BaseController
{
    private $AdministradoresModel;
    private $historialModel;
    private $admin;
    public function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
        $this->historialModel = new HistorialAdminModel();
        $this->admin = \Config\Services::session();
    }
    public function CreateID($table)
    {
        $prefixes = [
            'historial' => 'ha'
        ];
        if (!isset($prefixes[$table])) {
            throw new \InvalidArgumentException("Invalid table name: $table");
        }
        $model = $this->{$table . 'Model'};
        $prefix = $prefixes[$table];
        do {
            $uuid = $prefix . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        } while ($model->where('id', $uuid)->first());
        return $uuid;
    }
    //Funciones para el super admin
    public function ValidarAdmin()
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

    public function CrearAdmin()
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
        $historialData = [
            'id' => $this->CreateID('historial'),
            'dni_admin' => $dni,
            'accion' => 'Creación de administrador',
            'motivo' => 'Nuevo administrador registrado',
            'realizado_por' => $this->admin->get('dni_admin'),
            'fecha_accion' => date('Y-m-d H:i:s', strtotime('-5 hours'))
        ];
        $this->historialModel->insert($historialData);
        session()->setFlashdata('success', 'Administrador creado exitosamente');
        return redirect()->back();
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
    }
}
