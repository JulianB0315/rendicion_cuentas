<?php

namespace App\Controllers;

use App\Models\EjeModel;
use App\Models\Ejes_SeleccionadosModel;
use App\Models\RendicionModel;


class ConferenciaController extends BaseController
{
    private $RendicionModel;
    private $Ejes_SeleccionadosModel;
    private $EjeModel;
    public function __construct()
    {
        $this->RendicionModel = new RendicionModel();
        $this->Ejes_SeleccionadosModel = new Ejes_SeleccionadosModel();
        $this->EjeModel = new EjeModel();
    }
    public function show($id)
    {
        $year = date('Y');
        $number = '';
        $rendicion = $this->RendicionModel->select('fecha')
            ->where('id_rendicion', $id)
            ->first();
        if (date('Y', strtotime($rendicion['fecha'])) == $year) {
            $rendiciones_del_año = $this->RendicionModel
                ->select('id_rendicion, fecha')
                ->where('YEAR(fecha)', $year)
                ->orderBy('fecha', 'ASC')
                ->findAll();

            // Si hay rendiciones, determinar si es la primera o segunda
            if (!empty($rendiciones_del_año)) {
                $number = ($rendiciones_del_año[0]['id_rendicion'] == $id) ? 'I' : 'II';
            }
        }

        if($rendicion) {
            $ejes_seleccionados = $this->Ejes_SeleccionadosModel
                ->select('id_eje')
                ->where('id_rendicion', $id)
                ->findAll();
            $ejes = [];
            foreach ($ejes_seleccionados as $eje) {
                $eje_data = $this->EjeModel
                    ->select('id_eje, tematica')
                    ->where('id_eje', $eje['id_eje'])
                    ->first();
                $ejes[] = $eje_data;
            }
        }

        return view('conferencia', [
            'fecha' => $rendicion['fecha'],
            'number' => $number,
            'year' => $year,
            'ejes' => $ejes
        ]);
    }
}
