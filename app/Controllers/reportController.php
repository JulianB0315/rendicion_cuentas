<?php

namespace App\Controllers;

use App\Models\EjeModel;
use App\Models\RendicionModel;
use App\Models\UsuarioModel;
use App\Models\PreguntaModel;

class ReportController extends BaseController
{
    private $RendicionModel;
    private $UsuarioModel;
    private $PreguntaModel;
    private $EjeModel;

    public function __construct()
    {
        $this->RendicionModel = new RendicionModel();
        $this->UsuarioModel = new UsuarioModel();
        $this->PreguntaModel = new PreguntaModel();
        $this->EjeModel = new EjeModel();
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

    public function mostrar_reporte()
    {
        $id_rendicion = $this->request->getGet('id_rendicion');
        $usuarios = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->findAll();
        $asistencia_si = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'si')->countAllResults();
        $asistencia_no = $this->UsuarioModel->where('id_rendicion', $id_rendicion)->where('asistencia', 'no')->countAllResults();
        $ejes = $this->EjeModel->findAll();

        // Obtener preguntas de cada usuario
        foreach ($usuarios as &$usuario) {
            // $usuario['preguntas'] = $this->PreguntaModel->where('id_pregunta', $usuario['id_pregunta'])->findAll();
            $db = \Config\Database::connect();
            $builder = $db->table('pregunta p');
            $builder->select('p.*, ps.id_eje_seleccionado, e.tematica');
            $builder->join('preguntas_seleccionadas ps', 'ps.id_pregunta = p.id_pregunta');
            $builder->join('ejes_seleccionados es', 'es.id_eje_seleccionado = ps.id_eje_seleccionado');
            $builder->join('eje e', 'e.id_eje = es.id_eje');
            $builder->where('p.id_pregunta', $usuario['id_pregunta']);

            $usuario['preguntas'] = $builder->get()->getResultArray();
        }


        return view('viewReport', [
            'usuarios' => $usuarios,
            'asistencia_si' => $asistencia_si,
            'asistencia_no' => $asistencia_no,
            'id_rendicion' => $id_rendicion
        ]);
    }
}
