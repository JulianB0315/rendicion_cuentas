<?php

namespace App\Models;

use CodeIgniter\Model;

class HistorialAdminModel extends Model
{
    protected $table = 'historial_admin';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'dni_admin',
        'accion',
        'motivo',
        'realizado_por',
        'fecha_accion'
    ];

    protected $useTimestamps = false;
    protected $updatedField  = false;

    public function getHistorialCompleto()
    {
        return $this->db->table($this->table . ' h')
            ->select('
                h.*,
                a.nombres_admin as admin_afectado,
                a.categoria_admin as categoria_admin,
                r.nombres_admin as realizado_por,
                r.categoria_admin as categoria_realizado_por
            ')
            ->join('administradores a', 'a.dni_admin = h.dni_admin')
            ->join('administradores r', 'r.dni_admin = h.realizado_por')
            ->orderBy('h.fecha_accion', 'DESC')
            ->get()
            ->getResultArray();
    }
    public function registrarAccion($idRegistro,$dniAdmin, $accion, $motivo=null)
    {
        $data = [
            'id' => $idRegistro,
            'dni_admin' => $dniAdmin,
            'accion' => $accion,
            'motivo' => $motivo,
            'realizado_por' => session()->get('dni_admin'),
            'fecha_accion' => date('Y-m-d H:i:s')
        ];
        $this->insert($data);
    }
}
