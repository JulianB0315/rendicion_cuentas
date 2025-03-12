<?php

namespace App\Controllers;

use App\Models\HistorialAdminModel;

class AdminHistorialController extends BaseController
{
    private $historialModel;
    private $admin;

    public function __construct()
    {
        $this->historialModel = new HistorialAdminModel();
        $this->admin = \Config\Services::session();
    }

    public function index()
    {
        if ($this->admin->get('categoria_admin') !== 'super_admin') {
            return redirect()->to(base_url('admin/'))
                ->with('error', 'No tienes permisos para ver el historial');
        }
        return view('historial_admins', [
            'nombre' => $this->admin->get('nombres_admin'),
            'historial' => $this->historialModel->getHistorialCompleto()
        ]);
    }
}
