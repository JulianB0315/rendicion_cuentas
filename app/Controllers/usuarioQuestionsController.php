<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\PreguntaModel;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\EjeModel;
use App\Models\RendicionModel;

class usuarioQuestionsController extends BaseController
{
    private $UsuarioModel;
    private $PreguntaModel;
    private $Ejes_SeleccionadosModel;
    private $EjeModel;
    private $RendicionModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
        $this->PreguntaModel = new PreguntaModel();
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->EjeModel = new EjeModel();
        $this->RendicionModel = new RendicionModel();
    }
    public function index()
    {
        $contador_masculino = 0;
        $contador_femenino = 0;
        $contador_asistencia = 0;
        $contador_oradores = 0;

        $rendiciones = $this->RendicionModel->findAll();
        return view('usuarioQuestions', [
            'rendiciones' => $rendiciones,
            'contador_masculino' => $contador_masculino,
            'contador_femenino' => $contador_femenino,
            'contador_asistencia' => $contador_asistencia,
            'contador_oradores' => $contador_oradores,
        ]);
    }
    public function buscar_rendecion_admin()
    {
        $id_rendicion = $this->request->getGet('id_rendicion');
        $usuarios = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'si')->findAll();

        $contador_masculino = 0;
        $contador_femenino = 0;
        $contador_asistencia = 0;
        $contador_oradores = 0;

        foreach ($usuarios as &$usuario) {
            if ($usuario['sexo'] == 'M') {
                $contador_masculino++;
            } elseif ($usuario['sexo'] == 'F') {
                $contador_femenino++;
            }

            if ($usuario['asistencia'] == 'si') {
                $contador_asistencia++;
            }

            if ($usuario['tipo_participacion'] == 'orador') {
                $contador_oradores++;
            }

            if (empty($usuario['id_pregunta'])) {
                $usuario['pregunta_contenido'] = 'Solo asistió a la rendición';
                $usuario['eje_tema'] = '';
            } else {
                $pregunta = $this->PreguntaModel->find($usuario['id_pregunta']);
                if ($pregunta) {
                    $eje = $this->EjeModel->find($pregunta['id_eje']);
                    $usuario['pregunta_contenido'] = $pregunta['contenido'];
                    $usuario['eje_tema'] = $eje ? $eje['tematica'] : 'No definido';
                } else {
                    $usuario['pregunta_contenido'] = 'No definido';
                    $usuario['eje_tema'] = 'No definido';
                }
            }
            $usuario['organizacion'] = $usuario['nombre_empresa'] ?? 'No tiene';
        }
        $rendiciones = $this->RendicionModel->findAll();

        return view('usuarioQuestions', [
            'usuarios' => $usuarios,
            'rendiciones' => $rendiciones,
            'contador_masculino' => $contador_masculino,
            'contador_femenino' => $contador_femenino,
            'contador_asistencia' => $contador_asistencia,
            'contador_oradores' => $contador_oradores,
        ]);
    }
}
