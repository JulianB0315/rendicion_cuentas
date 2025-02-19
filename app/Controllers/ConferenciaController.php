<?php

namespace App\Controllers;

use App\Models\EjeModel;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\RendicionModel;
use App\Models\PreguntaModel;
use App\Models\Preguntas_seleccionadasModel;


class ConferenciaController extends BaseController
{
    private $RendicionModel;
    private $Ejes_SeleccionadosModel;
    private $EjeModel;
    private $PreguntaModel;
    private $Preguntas_seleccionadasModel;

    public function __construct()
    {
        $this->RendicionModel = new RendicionModel();
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->EjeModel = new EjeModel();
        $this->PreguntaModel = new PreguntaModel();
        $this->Preguntas_seleccionadasModel = new Preguntas_seleccionadasModel();
    }
    public function show($id)
    {
        $year = date('Y');
        $number = '';
        $rendicion = $this->RendicionModel->select('fecha')
            ->where('id_rendicion', $id)
            ->first();
        if (date('Y', strtotime($rendicion['fecha'])) == $year) {
            $rendiciones_del_año = $this->RendicionModel
                ->select('id_rendicion, fecha')
                ->where('YEAR(fecha)', $year)
                ->orderBy('fecha', 'ASC')
                ->findAll();
            if (!empty($rendiciones_del_año)) {
                $number = ($rendiciones_del_año[0]['id_rendicion'] == $id) ? 'I' : 'II';
            }
        }

        if ($rendicion) {
            $ejes_seleccionados = $this->Ejes_SeleccionadosModel
                ->select('id_eje')
                ->where('id_rendicion', $id)
                ->findAll();
            $ejes = [];
            foreach ($ejes_seleccionados as $eje) {
                $eje_data = $this->EjeModel
                    ->select('id_eje, tematica')
                    ->where('id_eje', $eje['id_eje'])
                    ->first();
                $ejes[] = $eje_data;
            }
        }

        return view('conferencia', [
            'fecha' => $rendicion['fecha'],
            'number' => $number,
            'year' => $year,
            'ejes' => $ejes,
            'id_rendicion' => $id
        ]);
    }
    public function obtenerPreguntas($id_eje, $id_rendicion)
    {
        $eje_seleccionado = $this->Ejes_SeleccionadosModel
            ->where('id_eje', $id_eje)
            ->where('id_rendicion', $id_rendicion)
            ->first();

        if (!$eje_seleccionado) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Eje seleccionado no encontrado'
            ]);
        }
        $preguntas = $this->Preguntas_seleccionadasModel
            ->select('preguntas_seleccionadas.*, pregunta.contenido, usuario.nombres')
            ->join('pregunta', 'pregunta.id_pregunta = preguntas_seleccionadas.id_pregunta')
            ->join('usuario', 'usuario.id_usuario = pregunta.id_usuario')
            ->where('preguntas_seleccionadas.id_eje_seleccionado', $eje_seleccionado['id_eje_seleccionado'])
            ->where('usuario.id_rendicion', $id_rendicion)
            ->findAll();
        return $this->response->setJSON([
            'success' => true,
            'data' => $preguntas,
            'debug' => [
                'id_eje_seleccionado' => $eje_seleccionado['id_eje_seleccionado'],
                'id_rendicion' => $id_rendicion
            ]
        ]);
    }
}
