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
        $fecha = date('Y-m-d');
        $rendicion = $this->RendicionModel->select('id_rendicion, fecha')
            ->where('fecha >=', $fecha)
            ->orderBy('fecha', 'ASC');
        return view('dashboard', ['rendiciones' => $rendicion->findAll()]);
    }
}
