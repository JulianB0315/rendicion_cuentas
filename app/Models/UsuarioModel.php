<?php

namespace App\Models;

class UsuarioModel extends \CodeIgniter\Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_usuario',
        'nombres',
        'sexo',
        'tipo_participacion',
        'titulo',
        'ruc_empresa',
        'nombre_empresa',
        'id_pregunta',
        'DNI',
        'id_rendicion',
        'asistencia'
    ];

    protected $useTimestamps = false;
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
