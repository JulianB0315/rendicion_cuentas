<?php

namespace App\Controllers;

use App\Models\Ejes_SeleccionadosModel;
use App\Models\PreguntaModel;
use App\Models\RendicionModel;
use App\Models\EjeModel;

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

    public function index()
    {
        return view('questions');
    }

    public function search()
    {
        $fecha = $this->request->getPost('rendicion_date');
        $rendicion = $this->RendicionModel->where('fecha', $fecha)->first();

        if ($rendicion) {
            $ejes_seleccionados = $this->Ejes_SeleccionadosModel
                ->where('id_rendicion', $rendicion['id_rendicion'])
                ->findAll();

            $ejes = [];
            foreach ($ejes_seleccionados as $eje_seleccionado) {
                $eje = $this->EjeModel->find($eje_seleccionado['id_eje']);
                $preguntas = $this->PreguntaModel
                    ->where('id_eje', $eje_seleccionado['id_eje'])
                    ->findAll();

                $ejes[] = [
                    'nombre' => $eje['tematica'],
                    'preguntas' => $preguntas
                ];
            }

            return view('questions', ['ejes' => $ejes]);
        } else {
            return view('questions', ['ejes' => []]);
        }
    }

    public function sort()
    {
        $cantidad_preguntas = $this->request->getPost('cantidad_preguntas');
        $preguntas = $this->PreguntaModel->findAll();

        if ($cantidad_preguntas > count($preguntas)) {
            $cantidad_preguntas = count($preguntas);
        }

        shuffle($preguntas);
        $preguntas_sorteadas = array_slice($preguntas, 0, $cantidad_preguntas);

        return view('questions', ['preguntas_sorteadas' => $preguntas_sorteadas]);
    }
}