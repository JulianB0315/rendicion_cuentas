<?php

namespace App\Controllers;

use App\Models\EjeModel;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\RendicionModel;
use App\Models\PreguntaModel;
use App\Models\Preguntas_seleccionadasModel;


class ConferenciaController extends BaseController
{
    private $RendicionModel;
    private $Ejes_SeleccionadosModel;
    private $EjeModel;
    private $PreguntaModel;
    private $Preguntas_seleccionadasModel;

    public function __construct()
    {
        $this->RendicionModel = new RendicionModel();
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->EjeModel = new EjeModel();
        $this->PreguntaModel = new PreguntaModel();
        $this->Preguntas_seleccionadasModel = new Preguntas_seleccionadasModel();
    }
    
    
}
