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
    public function crear_id()
    {
        do {
            $id = 'US' . substr(uniqid(), -8);
            $existe = $this->UsuarioModel->find($id);
        } while ($existe);
        return $id;
    }
    public function buscar_rendicion() {
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
            return view('form', ['ejes' => $ejes]);
        } else {
            echo "No se encontró la rendición";
        }
    }
    
    public function procesar_formulario()
    {
        $data_quiz = [
            'id_pregunta' => $this->crear_id(),
            'contenido' => $this->request->getPost('pregunta'),
            'dni_usuario' => $this->request->getPost('dni'),
            'id_eje' => "12345678",
            'fecha_registro' => date('Y-m-d')
        ];
        $data_user = [
            'DNI' => $this->request->getPost('dni'),
            'nombres' => $this->request->getPost('nombre'),
            'sexo' => "M",
            'tipo_participacion' => $this->request->getPost('participacion'),
            'titulo' => $this->request->getPost('titular') ?? null,
            'ruc_empresa' => $this->request->getPost('ruc') ?? null,
            'id_pregunta' => $data_quiz['id_pregunta'],
            'nombre_empresa' => $this->request->getPost('nombre_organizacion') ?? null,
            'id_usuario' => $this->crear_id()
        ];

        $usuarioExistente = $this->UsuarioModel->find($data_user['DNI']);
        if ($usuarioExistente) {
            return redirect()->to('/form')->with('error', 'El usuario ya existe.');
        }

        if (!$this->UsuarioModel->insert($data_user)) {
            echo "Error en la inserción";
            print_r($this->UsuarioModel->errors());
            exit();
        }

        if (!$this->PreguntaModel->insert($data_quiz)) {
            echo "Error en la inserción";
            print_r($this->UsuarioModel->errors());
            exit();
        }

        try {
            // echo '<pre>';
            // print_r($data_user);
            // echo '</pre>';
            // echo '<pre>';
            // print_r($data_quiz);
            // echo '</pre>';
            exit();
            $this->UsuarioModel->insert($data_user);
            $this->PreguntaModel->insert($data_quiz);
            return redirect()->to('/form')->with('message', 'Formulario procesado correctamente');
        } catch (\Exception $e) {
            return redirect()->to('/form')->with('error', 'Error: ' . $e->getMessage());
        }

        // echo json_encode($data_user);
        // echo json_encode($data_quiz);
    }
}
