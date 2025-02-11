<?php

namespace App\Controllers;

class FormController extends BaseController
{
    public function index()
    {
        return view('form');
    }
    public function procesar_formulario()
    {
        $data = [
            'numero' => $this->request->getPost('numero'),
            'nombre' => $this->request->getPost('nombre'),
            'participacion' => $this->request->getPost('participacion'),
            'titular' => $this->request->getPost('titular') ?? null,
            'ruc' => $this->request->getPost('ruc') ?? null,
            'eje' => $this->request->getPost('eje') ?? null,
            'nombre_organizacion' => $this->request->getPost('nombre_organizacion') ?? null,
            'pregunta' => $this->request->getPost('pregunta') ?? null,
        ];
        // echo "<p><strong>DNI:</strong> " . $data['numero'] . "</p>";
        // echo "<p><strong>Nombre:</strong> " . $data['nombre'] . "</p>";
        // echo "<p><strong>Participación:</strong> " . $data['participacion'] . "</p>";
        // echo "<p><strong>Titular:</strong> " . $data['titular'] . "</p>";
        // echo "<p><strong>RUC:</strong> " . $data['ruc'] . "</p>";
        // echo "<p><strong>Nombre de la Organización:</strong> " . $data['nombre_organizacion'] . "</p>";
        // echo "<p><strong>Eje Temático:</strong> " . $data['eje'] . "</p>";
        // echo "<p><strong>Pregunta:</strong> " . $data['pregunta'] . "</p>";
    }
}
