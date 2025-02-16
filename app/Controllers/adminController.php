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
    public function crear_id_rendicion()
    {
        $fecha = $this->request->getPost('fechaRendicion');
        $fechaSinGuiones = str_replace('-', '', $fecha);

        do {
            $random = rand(10, 99);
            $id = 'RE' . substr($fechaSinGuiones, -6) . $random;
            $existe = $this->RendicionModel->find($id);
        } while ($existe);

        return $id;
    }

    public function crear_id_selecionados()
    {
        do {
            $id = 'SE' . substr(uniqid(), -8);
            $existe = $this->Ejes_SeleccionadosModel->find($id);
        } while ($existe);
        return $id;
    }
    public function crear_id_ejes()
    {
        do {
            $id = 'E' . substr(uniqid(), -8);
            $existe = $this->EjeModel->find($id);
        } while ($existe);
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
    public function crear_rendicion()
    {
        $data_rendicion = [
            'id_rendicion' => $this->crear_id_rendicion(),
            'fecha' => $this->request->getPost('fechaRendicion')
        ];
        $this->RendicionModel->insert($data_rendicion);

        $ejes_seleccionados = $this->request->getPost('ejes');

        foreach ($ejes_seleccionados as $eje) {
            $data_ejes_seleccionados = [
                'id_eje_seleccionado' => $this->crear_id_selecionados(),
                'id_rendicion' => $data_rendicion['id_rendicion'],
                'id_eje' => $eje
            ];
            $this->Ejes_SeleccionadosModel->insert($data_ejes_seleccionados);
        }
        return redirect()->to('/admin');
    }
    public function crear_eje()
    {
        $data_eje = [
            'id_eje' => $this->crear_id_ejes(),
            'tematica' => $this->request->getPost('nombreEje')
        ];

        $this->EjeModel->insert($data_eje);
        return redirect()->to('/admin');
    }
}
