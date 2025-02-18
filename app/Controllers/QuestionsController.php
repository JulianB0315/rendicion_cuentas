<?php

namespace App\Controllers;

use App\Models\Ejes_SeleccionadosModel;
use App\Models\PreguntaModel;
use App\Models\RendicionModel;
use App\Models\EjeModel;
use App\Models\UsuarioModel;

class QuestionsController extends BaseController
{
    private $Ejes_SeleccionadosModel;
    private $PreguntaModel;
    private $RendicionModel;
    private $EjeModel;

    public function __construct()
    {
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->PreguntaModel = new PreguntaModel();
        $this->RendicionModel = new RendicionModel();
        $this->EjeModel = new EjeModel();
    }

    public function cargar_fechas()
    {
        $rendiciones = $this->RendicionModel->findAll();
        return view('questions', ['rendiciones' => $rendiciones]);
    }

    public function buscar_rendecion_admin()
    {
        $id_rendicion = $this->request->getPost('id_rendicion');
        $ejes_seleccionados = $this->Ejes_SeleccionadosModel
            ->where('id_rendicion', $id_rendicion)
            ->findAll();
        $ejes = array_map(function ($eje) {
            $preguntas = $this->PreguntaModel
                ->where('id_eje', $eje['id_eje'])
                ->findAll();
            return [
                'nombre' => $this->EjeModel->find($eje['id_eje'])['tematica'],
                'preguntas' => $preguntas
            ];
        }, $ejes_seleccionados);

        $rendiciones = $this->RendicionModel->findAll();

        return view('questions', ['ejes' => $ejes, 'rendiciones' => $rendiciones]);
    }
}
