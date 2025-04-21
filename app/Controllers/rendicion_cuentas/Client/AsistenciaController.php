<?php

namespace App\Controllers\rendicion_cuentas\Client;

use App\Controllers\BaseController;
use App\Models\rendicion_cuentas\RendicionModel;
use App\Models\rendicion_cuentas\UsuarioModel;


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
        $year = date('Y');
        $number = '';
        $fecha = date('Y-m-d', strtotime('now -5 hours'));
        $rendicion = $this->RendicionModel->select('id, fecha')
            ->where('fecha >=', $fecha)
            ->orderBy('fecha', 'ASC')
            ->first();
        if (date('Y', strtotime($rendicion['fecha'])) == $year) {
            $rendiciones_del_año = $this->RendicionModel
                ->select('id, fecha')
                ->where('YEAR(fecha)', $year)
                ->orderBy('fecha', 'ASC')
                ->findAll();

            // Si hay rendiciones, determinar si es la primera o segunda
            if (!empty($rendiciones_del_año)) {
                $number = ($rendiciones_del_año[0]['id'] == $rendicion['id']) ? 'I' : 'II';
            }
        }
        return view('rendicion_cuentas/Client/asistencia', [
            'fecha' => $rendicion['fecha'],
            'number' => $number,
            'year' => $year
        ]);
    }
    public function procesar_asistencia()
    {
        $fecha = date('Y-m-d', strtotime('now -5 hours'));
        $rendicion = $this->RendicionModel->select('id, fecha')
            ->where('fecha >=', $fecha)
            ->orderBy('fecha', 'ASC')
            ->first();

        $dni = $this->request->getPost('dni');

        if (!$rendicion) {
            return redirect()->back()->with('error', 'No hay conferencia programada para hoy');
        }

        $usuario = $this->UsuarioModel
            ->select('asistencia, id')
            ->where('DNI', $dni)
            ->where('id', $rendicion['id'])
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
                ->where('id', $rendicion['id'])
                ->update();

            if ($updated) {
                return redirect()->to(RUTA_ASISTENCIA)->with('success', 'Asistencia registrada correctamente');
            } else {
                return redirect()->to(RUTA_ASISTENCIA)->with('error', 'Error al registrar asistencia');
            }
        } catch (\Exception $e) {
            log_message('error', $e->getMessage());
            return redirect()->to(RUTA_ASISTENCIA)->with('error', 'Error al procesar la asistencia');
        }
    }
}
