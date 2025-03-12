<?php

namespace App\Models;

class administradoresModel extends \CodeIgniter\Model
{
    protected $table = 'administradores';
    protected $primaryKey = 'dni_admin';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'dni_admin',
        'nombres_admin',
        'password',
        'categoria_admin',
        'estado',
        'motivo_deshabilitado',
        'fecha_deshabilitado'
    ];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'creado_en';
    protected $updatedField = 'actualizado_en';
}