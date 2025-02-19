<?php

namespace App\Controllers;

use App\Models\Preguntas_seleccionadasModel;
use App\Models\RendicionModel;

class SortController extends BaseController
{
    private $Preguntas_seleccionadasModel;
    private $RendicionModel;
    public function __construct()
    {
        $this->Preguntas_seleccionadasModel = new Preguntas_seleccionadasModel();
        $this->RendicionModel = new RendicionModel();
    }

    public function index()
    {
        return view('sort');
    }
    private function crear_id_pregunta_seleccionada()
    {
        return 'PS' . substr(uniqid(), -8);
    }
    public function procesar_seleccion()
    {
        $id_eje_seleccionado = $this->request->getPost('id_eje_seleccionado');
        $id_rendicion        = $this->request->getPost('id_rendicion');
        $preguntas_seleccionadas = $this->request->getPost('preguntas_seleccionadas'); 

        if (empty($preguntas_seleccionadas)) {
            return redirect()->back()->with('error', 'No se seleccionaron preguntas.');
        }

        foreach ($preguntas_seleccionadas as $id_pregunta) {
            $data = [
                'id_pregunta_seleccionada' => $this->crear_id_pregunta_seleccionada(),
                'id_eje_seleccionado'      => $id_eje_seleccionado,
                'id_pregunta'              => $id_pregunta
            ];
            $this->Preguntas_seleccionadasModel->insert($data);
        }

        $rendiciones = $this->RendicionModel->findAll();
        return view('questions', ['rendiciones' => $rendiciones]);
    }
}
