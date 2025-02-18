<?php

namespace App\Controllers;

use App\Models\RendicionModel;
use App\Models\UsuarioModel;


class AsistenciaController extends BaseController
{
    private $RendicionModel;
    private $UsuarioModel;
    public function __construct()
    {
        $this->RendicionModel = new RendicionModel();
        $this->UsuarioModel = new UsuarioModel();
    }
    public function index()
    {
        $fecha = date('Y-m-d', strtotime('now -5 hours'));
        $rendicion = $this->RendicionModel->select('id_rendicion, fecha')
            ->where('fecha >=', $fecha)
            ->orderBy('fecha', 'ASC')
            ->first();
        return view('asistencia', ['fecha' => $rendicion['fecha']]);
    }
    public function procesar_asistencia()
    {
        $fecha = date('Y-m-d', strtotime('now -5 hours'));
        $rendicion = $this->RendicionModel->select('id_rendicion, fecha')
            ->where('fecha >=', $fecha)
            ->orderBy('fecha', 'ASC')
            ->first();

        $dni = $this->request->getPost('dni');

        if (!$rendicion) {
            return redirect()->back()->with('error', 'No hay conferencia programada para hoy');
        }

        $usuario = $this->UsuarioModel
            ->select('asistencia, id_rendicion')
            ->where('DNI', $dni)
            ->where('id_rendicion', $rendicion['id_rendicion'])
            ->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'No estás registrado para esta conferencia');
        }
        if ($usuario['asistencia'] == 'si') {
            return redirect()->back()->with('error', 'Ya registraste tu asistencia anteriormente');
        }

        try {
            $updated = $this->UsuarioModel->set('asistencia', 'si')
                ->where('DNI', $dni)
                ->where('id_rendicion', $rendicion['id_rendicion'])
                ->update();

            if ($updated) {
                return redirect()->back()->with('success', 'Asistencia registrada correctamente');
            } else {
                return redirect()->back()->with('error', 'Error al registrar asistencia');
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return redirect()->back()->with('error', 'Error al procesar la asistencia');
        }
    }
}
