<?php

namespace App\Controllers;
use App\Models\Preguntas_seleccionadasModel;
use App\Models\RendicionModel;
class SelectionController extends BaseController
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
        return view('selection');
    }
    public function borrar_seleccion(){
        $preguntas_seleccionadas = $this->request->getPost('preguntas_seleccionadas');
        if (empty($preguntas_seleccionadas)) {
            return redirect()->back()->with('error', 'No se seleccionaron preguntas.');
        }
        $deleted_ids = [];
        foreach ($preguntas_seleccionadas as $id_pregunta) {
            if ($this->Preguntas_seleccionadasModel
            ->where('id_pregunta', $id_pregunta)
            ->delete()) {
            $deleted_ids[] = $id_pregunta;
            }
        }
        $rendiciones = $this->RendicionModel->findAll();
        return view('viewQuestions', ['rendiciones' => $rendiciones]);
    }
}