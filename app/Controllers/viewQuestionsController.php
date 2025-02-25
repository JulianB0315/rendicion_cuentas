<?php

namespace App\Controllers;

use App\Models\RendicionModel;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\EjeModel;
use App\Models\Preguntas_seleccionadasModel;

class viewQuestionsController extends BaseController
{
    private $RendicionModel;
    private $Ejes_SeleccionadosModel;
    private $EjeModel;
    private $Preguntas_seleccionadasModel;
    public function __construct()
    {
        $this->RendicionModel = new RendicionModel();
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->Preguntas_seleccionadasModel = new Preguntas_seleccionadasModel;
        $this->EjeModel = new EjeModel();
    }
    public function index()
    {
        return view('viewQuestions');
    }
    public function cargar_fechas()
    {
        $rendiciones = $this->RendicionModel->findAll();
        return view('viewQuestions', ['rendiciones' => $rendiciones]);
    }
    public function buscar_rendecion_admin()
    {
        $id_rendicion = $this->request->getPost('id_rendicion');

        $ejes_seleccionados = $this->Ejes_SeleccionadosModel
            ->where('id_rendicion', $id_rendicion)
            ->findAll();

        $ejes = array_map(function ($eje) use ($id_rendicion) {
            $ejeData = $this->EjeModel->find($eje['id_eje']);
            $db = \Config\Database::connect();
            $builder = $db->table('preguntas_seleccionadas ps');
            $builder->select('ps.id_pregunta_seleccionada, ps.id_pregunta, p.contenido, p.fecha_registro, u.nombres');
            $builder->join('pregunta p', 'p.id_pregunta = ps.id_pregunta');
            $builder->join('usuario u', 'u.id_usuario = p.id_usuario');
            $builder->where('ps.id_eje_seleccionado', $eje['id_eje_seleccionado']);
            $builder->where('u.id_rendicion', $id_rendicion);
            $query = $builder->get()->getResultArray();
            return [
                'tematica'=> isset($ejeData['tematica']) ? $ejeData['tematica'] : 'Sin tematica',
                'id_eje_seleccionado' => $eje['id_eje_seleccionado'],
                'preguntas' => $query
            ];
        }, $ejes_seleccionados);

        $rendiciones = $this->RendicionModel->findAll();
        return view('viewQuestions', ['ejes' => $ejes, 'rendiciones' => $rendiciones]);
    }
    public function borrar_pregunta(){
        $id_pregunta_seleccionada = $this->request->getPost('id_pregunta_seleccionada');
        $pregunta_seleccionada = $this->Preguntas_seleccionadasModel->find($id_pregunta_seleccionada);
        if (!$pregunta_seleccionada) {
            return redirect()->back()->with('error', 'Pregunta no encontrada.');
        }
        if ($this->Preguntas_seleccionadasModel->delete($id_pregunta_seleccionada)) {
            return redirect()->to(base_url('viewQuestions/'));
        }
        return redirect()->back()->with('error', 'No se pudo borrar la pregunta.');
    }
    public function mostrar_preguntas_seleccionadas($id_eje_seleccionado)
    {
        $eje_seleccionado = $this->Ejes_SeleccionadosModel->find($id_eje_seleccionado);
        if (!$eje_seleccionado) {
            throw new \Exception("Eje seleccionado no encontrado.");
        }

        $id_rendicion = $eje_seleccionado['id_rendicion'];
        $id_eje = $eje_seleccionado['id_eje'];

        $eje = $this->EjeModel->find($id_eje);
        if (!$eje) {
            throw new \Exception("Eje no encontrado.");
        }

        $db = \Config\Database::connect();
        $builder = $db->table('preguntas_seleccionadas ps');
        $builder->select('ps.id_pregunta_seleccionada, ps.id_pregunta, p.contenido, p.fecha_registro, u.nombres, u.DNI, u.ruc_empresa, u.nombre_empresa');
        $builder->join('pregunta p', 'p.id_pregunta = ps.id_pregunta');
        $builder->join('usuario u', 'u.id_usuario = p.id_usuario');
        $builder->where('ps.id_eje_seleccionado', $id_eje_seleccionado);
        $builder->where('u.id_rendicion', $id_rendicion);
        $query = $builder->get();
        $preguntas = $query->getResultArray();

        return view('selection', [
            'eje'                 => $eje,
            'preguntas'           => $preguntas,
            'id_eje_seleccionado' => $id_eje_seleccionado,
            'id_rendicion'        => $id_rendicion
        ]);
    }
}
