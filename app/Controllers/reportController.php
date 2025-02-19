<?php

namespace App\Controllers;

use App\Models\RendicionModel;
use App\Models\UsuarioModel;
use App\Models\PreguntaModel;
class ReportController extends BaseController
{
    private $RendicionModel;
    private $UsuarioModel;
    private $PreguntaModel;

    public function __construct()
    {
        $this->RendicionModel = new RendicionModel();
        $this->UsuarioModel = new UsuarioModel();
        $this->PreguntaModel = new PreguntaModel();
    }

    public function index()
    {
        return view('report');
    }

    public function mostrar_rendiciones()
    {
        $rendiciones = $this->RendicionModel->findAll();
        return view('report', ['rendiciones' => $rendiciones]);
    }

    public function mostrar_reporte($id_rendicion)
    {
        $usuarios = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->findAll();
        $asistencia_si = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'si')->countAllResults();
        $asistencia_no = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'no')->countAllResults();

        // Obtener preguntas de cada usuario
        foreach ($usuarios as &$usuario) {
            $usuario['preguntas'] = $this->PreguntaModel->where('id_pregunta', $usuario['id_pregunta'])->findAll();
        }

        return view('viewReport', [
            'usuarios' => $usuarios,
            'asistencia_si' => $asistencia_si,
            'asistencia_no' => $asistencia_no,
            'id_rendicion' => $id_rendicion
        ]);
    }
}