<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\RendicionModel;
use App\Models\EjeModel;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\PreguntaModel;
use App\Models\Preguntas_seleccionadasModel;
use App\Models\UsuarioModel;

class DasboardUserController extends BaseController
{
    private $rendicionModel;
    private $ejeModel;
    private $ejesSeleccionadosModel;
    private $preguntaModel;
    private $preguntasSeleccionadasModel;
    private $usuarioModel;
    public function __construct()
    {
        $this->rendicionModel = new RendicionModel();
        $this->ejeModel = new EjeModel();
        $this->ejesSeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->preguntaModel = new PreguntaModel();
        $this->preguntasSeleccionadasModel = new Preguntas_seleccionadasModel();
        $this->usuarioModel = new UsuarioModel();
    }
    //Funciones de dashaboard
    public function index()
    {
        $year = date('Y');
        $rendicion = $this->rendicionModel
            ->select('id, fecha, banner_rendicion')
            ->where('YEAR(fecha)', $year)
            ->orderBy('fecha', 'ASC')
            ->findAll();

        $firstBanner = !empty($rendicion) ? $rendicion[0]['banner_rendicion'] : null;

        return view('dashboard', [
            'rendiciones' => $rendicion,
            'firstBanner' => $firstBanner
        ]);
    }

    public function Conferencia($id)
    {
        $year = date('Y');
        $number = '';
        $rendicion = $this->rendicionModel->select('fecha, hora_rendicion')
            ->where('id', $id)
            ->first();
        if (date('Y', strtotime($rendicion['fecha'])) == $year) {
            $rendiciones_del_año = $this->rendicionModel
                ->select('id, fecha')
                ->where('YEAR(fecha)', $year)
                ->orderBy('fecha', 'ASC')
                ->findAll();
            if (!empty($rendiciones_del_año)) {
                $number = ($rendiciones_del_año[0]['id'] == $id) ? 'I' : 'II';
            }
        }

        if ($rendicion) {
            $ejes_seleccionados = $this->ejesSeleccionadosModel
                ->select('id_eje')
                ->where('id_rendicion', $id)
                ->findAll();
            $ejes = [];
            foreach ($ejes_seleccionados as $eje) {
                $eje_data = $this->ejeModel
                    ->select('id, tematica')
                    ->where('id', $eje['id_eje'])
                    ->first();
                $ejes[] = $eje_data;
            }
        }
        $hora_formateada = date('h:i A', strtotime($rendicion['hora_rendicion']));
        return view('conferencia', [
            'fecha' => $rendicion['fecha'],
            'hora_rendicion' => $hora_formateada,
            'number' => $number,
            'year' => $year,
            'ejes' => $ejes,
            'id_rendicion' => $id
        ]);
    }

    //Funciones de preguntas del dashboard
    public function obtenerPreguntas($id_eje, $id_rendicion)
    {
        $eje_seleccionado = $this->ejesSeleccionadosModel
            ->where('id_eje', $id_eje)
            ->where('id_rendicion', $id_rendicion)
            ->first();

        if (!$eje_seleccionado) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Eje seleccionado no encontrado'
            ]);
        }
        $preguntas = $this->preguntasSeleccionadasModel
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

    //Funciones de reportes de preguntas
    public function Report()
    {
        $contador_masculino = 0;
        $contador_femenino = 0;
        $contador_asistencia = 0;
        $contador_oradores = 0;

        $rendiciones = $this->rendicionModel
            ->findAll();
        return view('usuarioQuestions', [
            'rendiciones' => $rendiciones,
            'contador_masculino' => $contador_masculino,
            'contador_femenino' => $contador_femenino,
            'contador_asistencia' => $contador_asistencia,
            'contador_oradores' => $contador_oradores,
        ]);
    }

    public function DatosRendicion()
    {
        $id_rendicion = $this->request->getGet('id_rendicion');
        $usuarios = $this->usuarioModel
            ->where('id_rendicion', $id_rendicion)
            ->where('asistencia', 'si')
            ->findAll();
        $contador_masculino = 0;
        $contador_femenino = 0;
        $contador_asistencia = count($usuarios);
        $contador_oradores = 0;
        foreach ($usuarios as &$usuario) {
            $usuario['sexo'] === 'M' ? $contador_masculino++ : ($usuario['sexo'] === 'F' ? $contador_femenino++ : null);
            $usuario['tipo_participacion'] === 'orador' && $contador_oradores++;
            if (!empty($usuario['id_pregunta'])) {
                $pregunta = $this->preguntaModel->find($usuario['id_pregunta']);
                $eje = $pregunta ? $this->ejeModel->find($pregunta['id_eje']) : null;
                $usuario['pregunta_contenido'] = $pregunta['contenido'] ?? 'No definido';
                $usuario['eje_tema'] = $eje['tematica'] ?? 'No definido';
            } else {
                $usuario['pregunta_contenido'] = 'Solo asistió a la rendición';
                $usuario['eje_tema'] = '';
            }

            $usuario['organizacion'] = $usuario['nombre_empresa'] ?? 'No tiene';
        }

        return view('usuarioQuestions', [
            'usuarios' => $usuarios,
            'rendiciones' => $this->rendicionModel->findAll(),
            'contador_masculino' => $contador_masculino,
            'contador_femenino' => $contador_femenino,
            'contador_asistencia' => $contador_asistencia,
            'contador_oradores' => $contador_oradores,
        ]);
    }
}
