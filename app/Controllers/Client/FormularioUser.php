<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\RendicionModel;
use App\Models\EjeModel;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\PreguntaModel;
use App\Models\UsuarioModel;

class FormularioUser extends BaseController
{
    private $rendicionModel;
    private $ejeModel;
    private $ejesSeleccionadosModel;
    private $preguntaModel;
    private $usuarioModel;
    public function __construct()
    {
        $this->rendicionModel = new RendicionModel();
        $this->ejeModel = new EjeModel();
        $this->ejesSeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->preguntaModel = new PreguntaModel();
        $this->usuarioModel = new UsuarioModel();
    }
    public function CreateID($table)
    {
        $prefixes = [
            'usuario' => 'us',
            'pregunta' => 'pr',
        ];
        if (!isset($prefixes[$table])) {
            throw new \InvalidArgumentException("Invalid table name: $table");
        }
        $model = $this->{$table . 'Model'};
        $prefix = $prefixes[$table];
        do {
            $uuid = $prefix . strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        } while ($model->where('id', $uuid)->first());
        return $uuid;
    }
//Funciones del formulario
    public function BuscarRendicion()
    {
        $number = '';
        $year = date('Y');
        $fecha = date('Y-m-d', strtotime('now -5 hours'));
        $rendicion = $this->rendicionModel
            ->select('id, fecha')
            ->where('fecha >=', $fecha)
            ->orderBy('fecha', 'ASC')
            ->first();
        if (date('Y', strtotime($rendicion['fecha'])) == $year) {
            $rendiciones_del_año = $this->rendicionModel
                ->select('id, fecha')
                ->where('YEAR(fecha)', $year)
                ->orderBy('fecha', 'ASC')
                ->findAll();
            if (!empty($rendiciones_del_año)) {
                $number = ($rendiciones_del_año[0]['id'] == $rendicion['id']) ? 'I' : 'II';
            }
        }

        if ($rendicion) {
            $fecha_rendicion = $rendicion['fecha'];
            $ejes_seleccionados = $this->ejesSeleccionadosModel
                ->select('id_eje')
                ->where('id_rendicion', $rendicion['id'])
                ->findAll();
            $ejes = [];
            foreach ($ejes_seleccionados as $eje) {
                $eje_data = $this->ejeModel
                    ->select('id, tematica')
                    ->where('id', $eje['id_eje'])
                    ->first();
                if ($eje_data) {
                    $ejes[] = $eje_data;
                }
            }
            return view('form', [
                'ejes' => $ejes,
                'id_rendicion' => $rendicion['id'],
                'fecha_rendicion' => $fecha_rendicion,
                'number' => $number
            ]);
        } else {
            echo "No se encontró la rendición";
            echo $fecha;
        }
    }

    public function ProcesarFormulario()
    {
        $dni = $this->request->getPost('dni');
        $id_rendicion = $this->request->getPost('id_rendicion');
        $usuario_existente = $this->usuarioModel
            ->where('DNI', $dni)
            ->where('id', $id_rendicion)
            ->first();

        if ($usuario_existente) {
            return redirect()->back()->with('error', 'El usuario con este DNI ya está registrado en la rendición actual');
        }
        $id_rendicion = $this->request->getPost('id_rendicion');
        $rendicion = $this->rendicionModel->find($id_rendicion);
        $fecha_conferencia = $rendicion['fecha'];
        $fecha_hoy = date('Y-m-d', strtotime('now -5 hours'));

        $asistencia = ($fecha_conferencia == $fecha_hoy) ? 'si' : 'no';
        $data_user['asistencia'] = $asistencia;
        $id_usuario = $this->CreateID('usuario');
        $data_user = [
            'id' => $id_usuario,
            'nombres' => $this->request->getPost('nombre'),
            'sexo' => $this->request->getPost('sexo'),
            'tipo_participacion' => $this->request->getPost('participacion'),
            'titulo' => $this->request->getPost('titular') ?? null,
            'ruc_empresa' => $this->request->getPost('ruc') ?? null,
            'nombre_empresa' => $this->request->getPost('nombre_organizacion') ?? null,
            'DNI' => $this->request->getPost('dni'),
            'id_rendicion' => $this->request->getPost('id_rendicion'),
            'asistencia' => $asistencia
        ];

        if (!$this->usuarioModel->insert($data_user)) {
            return redirect()->back()->with('error', 'Error al registrar al usuario');
        }

        $pregunta = $this->request->getPost('pregunta');
        if ($pregunta) {
            $data_quiz = [
                'id' => $this->CreateID('pregunta'),
                'contenido' => $pregunta,
                'id_usuario' => $id_usuario,
                'id_eje' => $this->request->getPost('id_eje'),
                'fecha_registro' => $fecha_hoy
            ];
            $data_user['id'] = $data_quiz['id'];

            if (!$this->preguntaModel->insert($data_quiz)) {
                echo "Error en la inserción de la pregunta";
                print_r($this->preguntaModel->errors());
                return;
            }

            $this->usuarioModel->update($id_usuario, ['id_pregunta' => $data_quiz['id']]);
        }

        $id_eje = $this->request->getPost('id_eje');
        $id_rendicion = $this->request->getPost('id_rendicion');
        $eje_seleccionado = $this->ejesSeleccionadosModel
            ->select('id, cantidad_preguntas')
            ->where('id_eje', $id_eje)
            ->where('id_rendicion', $id_rendicion)
            ->first();

        if ($this->request->getPost('id_eje')) {
            if ($eje_seleccionado) {
                $this->ejesSeleccionadosModel->update($eje_seleccionado['id'], ['cantidad_preguntas' => $eje_seleccionado['cantidad_preguntas'] + 1]);
                return redirect()->to('/')->with('success', 'Registro completado correctamente');
            } else {
                echo "No se encontró el eje seleccionado para actualizar la cantidad";
            }
        } else {
            return redirect()->to('/')->with('success', 'Registro completado correctamente');
        }
    }
}
