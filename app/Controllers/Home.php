<?php

namespace App\Controllers;
use App\Models\RendicionModel;


class Home extends BaseController
{
    private $RendicionModel;
    public function __construct()
    {
        $this->RendicionModel = new RendicionModel();
    }
    public function index()
    {
        $year = date('Y');
        $rendicion = $this->RendicionModel
            ->select('id_rendicion, fecha, banner_rendicion')
            ->where('YEAR(fecha)', $year)
            ->orderBy('fecha', 'ASC')
            ->findAll();
        
        $firstBanner = !empty($rendicion) ? $rendicion[0]['banner_rendicion'] : null;

        return view('dashboard', [
            'rendiciones' => $rendicion,
            'firstBanner' => $firstBanner
        ]);
    }
}
