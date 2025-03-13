<?php

namespace App\Controllers;

use App\Models\AdministradoresModel;
use App\Models\HistorialAdminModel;

/* TODO: hacer que las horas se guarden en hora peruana
*/

class Admin_UsersController extends BaseController
{
    private $AdministradoresModel;
    private $admin;
    private $historialModel;
    private $db;

    function __construct()
    {
        $this->AdministradoresModel = new AdministradoresModel();
        $this->admin = \Config\Services::session();
        $this->historialModel = new HistorialAdminModel();
        $this->db = \Config\Database::connect();
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
    public function crear_id_registro()
    {
        do {
            $id = 'R' . substr(uniqid(), -8);
            $existe = $this->historialModel->find($id);
        } while ($existe);
        return $id;
    }
    public function crear_admin()
    {
        $idRegistro = $this->crear_id_registro();
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
        $this->db->transStart();
        $this->historialModel->registrarAccion($idRegistro, $dni, 'crear');
        $this->db->transComplete();
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
        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'No se encontró el administrador'
        ]);
    }
    public function deshabilitar_admin($admin)
    {
        $motivo = $this->request->getGet('motivo');
        $idRegistro = $this->crear_id_registro();
        if (empty($motivo)) {
            session()->setFlashdata('error', 'El motivo es requerido');
            return redirect()->back();
        }
        $this->db->transStart();

        $this->AdministradoresModel->update($admin, [
            'estado' => 'deshabilitado'
        ]);

        $this->historialModel->registrarAccion($idRegistro, $admin, 'deshabilitar', $motivo);

        $this->db->transComplete();

        session()->setFlashdata('success', 'Administrador deshabilitado exitosamente');
        return redirect()->back();
    }
    function habilitar_admin($admin)
    {
        $idRegistro = $this->crear_id_registro();
        $this->db->transStart();
        $this->AdministradoresModel->update($admin, [
            'estado' => 'habilitado'
        ]);
        $this->historialModel->registrarAccion($idRegistro, $admin, 'habilitar');
        $this->db->transComplete();
        session()->setFlashdata('success', 'Administrador habilitado exitosamente');
        return redirect()->back();
    }
    public function editar_admin($admin)
    {
        $idRegistro = $this->crear_id_registro();
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $this->db->transStart();
        $this->AdministradoresModel->update($admin, [
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        $this->historialModel->registrarAccion($idRegistro, $admin, 'editar_password');
        $this->db->transComplete();
        session()->setFlashdata('success', 'Contraseña editada correctamente.');
        return redirect()->back();
    }
}
