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
                'cantidad_preguntas' => $eje['cantidad_preguntas']
            ];
        }, $ejes_seleccionados);

        $rendiciones = $this->RendicionModel->findAll();
        return view('questions', ['ejes' => $ejes, 'rendiciones' => $rendiciones]);
    }

    public function sorteo_preguntas()
    {
        $id_rendicion = $this->request->getPost('id_rendicion');
        $cantidad_preguntas = (int) $this->request->getPost('cantidad_preguntas');

        $usuarios = $this->UsuarioModel
            ->where('id_rendicion', $id_rendicion)
            ->where('id_pregunta IS NOT NULL', null, false)
            ->findAll();

        $preguntas_sorteadas = [];
        foreach ($usuarios as $usuario) {
            // Obtener todas las preguntas del usuario
            $preguntas_usuario = $this->PreguntaModel
                ->where('id_usuario', $usuario['id_usuario'])
                ->findAll();

            $ejes = [];
            foreach ($preguntas_usuario as $pregunta) {
                $eje_id = $pregunta['id_eje'];
                if (!isset($ejes[$eje_id])) {
                    $ejeData = $this->EjeModel->find($eje_id);
                    $ejes[$eje_id] = [
                        'id_eje'    => $eje_id,
                        'nombre'    => isset($ejeData['tematica']) ? $ejeData['tematica'] : '',
                        'preguntas' => []
                    ];
                }
                $ejes[$eje_id]['preguntas'][] = $pregunta;
            }

            foreach ($ejes as &$eje) {
                shuffle($eje['preguntas']); // Mezclar preguntas para mayor aleatoriedad
                $eje['preguntas'] = array_slice($eje['preguntas'], 0, $cantidad_preguntas); // Limitar a la cantidad seleccionada
            }

            $preguntas_sorteadas[] = [
                'usuario'   => $usuario,
                'ejes'      => $ejes
            ];
        }

        $rendiciones = $this->RendicionModel->findAll();

        return view('questions', [
            'preguntas_sorteadas' => $preguntas_sorteadas,
            'rendiciones'         => $rendiciones,
            'cantidad_preguntas'  => $cantidad_preguntas
        ]);
    }
}
