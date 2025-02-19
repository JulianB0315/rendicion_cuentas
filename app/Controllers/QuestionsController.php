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
    private $UsuarioModel;

    public function __construct()
    {
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->PreguntaModel = new PreguntaModel();
        $this->RendicionModel = new RendicionModel();
        $this->EjeModel = new EjeModel();
        $this->UsuarioModel = new UsuarioModel();
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
            $ejeData = $this->EjeModel->find($eje['id_eje']);
            return [
                'tematica'          => isset($ejeData['tematica']) ? $ejeData['tematica'] : 'Sin tematica',
                'cantidad_preguntas' => $eje['cantidad_preguntas'],
                'id_eje_seleccionado' => $eje['id_eje_seleccionado']
            ];
        }, $ejes_seleccionados);

        $rendiciones = $this->RendicionModel->findAll();
        return view('questions', ['ejes' => $ejes, 'rendiciones' => $rendiciones]);
    }

    public function sorteo_preguntas($id_eje_seleccionado)
    {
        $eje_seleccionado = $this->Ejes_SeleccionadosModel->find($id_eje_seleccionado);
        if (!$eje_seleccionado) {
            throw new \Exception("Eje seleccionado no encontrado.");
        }

        $eje = $this->EjeModel->find($eje_seleccionado['id_eje']);
        if (!$eje) {
            throw new \Exception("Eje no encontrado.");
        }

        $preguntas = $this->PreguntaModel
            ->select('pregunta.*, usuario.nombres, usuario.DNI, usuario.ruc_empresa, usuario.nombre_empresa')
            ->join('usuario', 'usuario.id_usuario = pregunta.id_usuario')
            ->where('pregunta.id_eje', $eje_seleccionado['id_eje'])
            ->where('usuario.id_rendicion', $eje_seleccionado['id_rendicion'])
            ->findAll();

        $id_rendicion = $eje_seleccionado['id_rendicion'];

        return view('sort', [
            'eje'                 => $eje,
            'preguntas'           => $preguntas,
            'id_eje_seleccionado' => $id_eje_seleccionado,
            'id_rendicion'        => $id_rendicion
        ]);
    }
}
