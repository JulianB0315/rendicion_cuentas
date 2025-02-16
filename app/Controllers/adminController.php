<?php

namespace App\Controllers;

use App\Models\EjeModel;
use App\Models\RendicionModel;
use App\Models\Ejes_SeleccionadosModel;

class adminController extends BaseController
{
    private $EjeModel;
    private $RendicionModel;
    private $Ejes_SeleccionadosModel;

    function __construct()
    {
        $this->RendicionModel = new RendicionModel();
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->EjeModel = new EjeModel();
    }
    public function crear_id()
    {
        $id = date('my') . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        return $id;
    }
    public function index()
    {
        return view('admin');
    }

    public function buscar_eje()
    {
        $data['ejes'] = $this->EjeModel->findAll();
        return view('admin', $data);
    }
    public function crear_eje()
    {
        $data_eje = [
            'id_eje' => $this->crear_id(),
            'tematica' => $this->request->getPost('nombreEje')
        ];
        $this->EjeModel->insert($data_eje);
        return redirect()->to('/admin');
    }
}
