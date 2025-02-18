<?php

namespace App\Controllers;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\PreguntaModel;
use App\Models\UsuarioModel;
use App\Models\EjeModel;

class SortController extends BaseController
{
    private $Ejes_SeleccionadosModel;
    private $PreguntaModel;
    private $UsuarioModel;
    private $EjeModel;
    
    public function __construct()
    {
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->PreguntaModel = new PreguntaModel();
        $this->UsuarioModel = new UsuarioModel();
        $this->EjeModel = new EjeModel();
    }
    
    public function index()
    {
        return view('sort');
    }
}