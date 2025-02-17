<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\PreguntaModel;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\RendicionModel;
use App\Models\EjeModel;

class FormController extends BaseController
{
    private $UsuarioModel;
    private $PreguntaModel;
    private $Ejes_SeleccionadosModel;
    private $RendicionModel;
    private $EjeModel;

    public function __construct()
    {
        $this->UsuarioModel = new UsuarioModel();
        $this->PreguntaModel = new PreguntaModel();
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->RendicionModel = new RendicionModel();
        $this->EjeModel = new EjeModel();
    }
    public function crear_id_usuario()
    {
        do {
            $id = 'US' . substr(uniqid(), -6);
            $existe = $this->UsuarioModel->find($id);
        } while ($existe);
        return $id;
    }
    public function crear_id_pregunta()
    {
        do {
            $id = 'PRE' . substr(uniqid(), -5);
            $existe = $this->UsuarioModel->find($id);
        } while ($existe);
        return $id;
    }
    public function buscar_rendicion()
    {
        $fecha = date('Y-m-d');
        $rendicion = $this->RendicionModel->select('id_rendicion, fecha')
            ->orderBy('ABS(DATEDIFF(fecha, "' . $fecha . '")) ASC')
            ->first();

        // echo $this->RendicionModel->getLastQuery();

        if ($rendicion) {
            $ejes_seleccionados = $this->Ejes_SeleccionadosModel
                ->select('id_eje')
                ->where('id_rendicion', $rendicion['id_rendicion'])
                ->findAll();
            $ejes = [];
            foreach ($ejes_seleccionados as $eje) {
                $eje_data = $this->EjeModel
                    ->select('id_eje, tematica')
                    ->where('id_eje', $eje['id_eje'])
                    ->first();
                if ($eje_data) {
                    $ejes[] = $eje_data;
                }
            }
            return view('form', ['ejes' => $ejes, 'id_rendicion' => $rendicion['id_rendicion']]);
        } else {
            echo "No se encontró la rendición";
        }
    }

    public function procesar_formulario()
    {
        $id_usuario = $this->crear_id_usuario();
        $data_user = [
            'id_usuario' => $id_usuario,
            'nombres' => $this->request->getPost('nombre'),
            'sexo' => "M",
            'tipo_participacion' => $this->request->getPost('participacion'),
            'titulo' => $this->request->getPost('titular') ?? null,
            'ruc_empresa' => $this->request->getPost('ruc') ?? null,
            'nombre_empresa' => $this->request->getPost('nombre_organizacion') ?? null,
            'DNI' => $this->request->getPost('dni'),
            'id_rendicion' => $this->request->getPost('id_rendicion'),
        ];

        if (!$this->UsuarioModel->insert($data_user)) {
            echo "Error en la inserción del usuario";
            print_r($this->UsuarioModel->errors());
            return;
        }

        $pregunta = $this->request->getPost('pregunta');
        if ($pregunta) {
            $data_quiz = [
                'id_pregunta' => $this->crear_id_pregunta(),
                'contenido' => $pregunta,
                'id_usuario' => $id_usuario,
                'id_eje' => $this->request->getPost('id_eje'),
                'fecha_registro' => date('Y-m-d')
            ];
            $data_user['id_pregunta'] = $data_quiz['id_pregunta'];

            if (!$this->PreguntaModel->insert($data_quiz)) {
                echo "Error en la inserción de la pregunta";
                print_r($this->PreguntaModel->errors());
                return;
            }

            $this->UsuarioModel->update($id_usuario, ['id_pregunta' => $data_quiz['id_pregunta']]);
        }
    }
}
