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
            ->select('id_rendicion, fecha')
            ->where('YEAR(fecha)', $year)
            ->orderBy('fecha', 'ASC');
        return view('dashboard', ['rendiciones' => $rendicion->findAll()]);
    }
}
