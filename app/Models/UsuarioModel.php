<?php

namespace App\Models;

class UsuarioModel extends \CodeIgniter\Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'DNI';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'DNI',
        'nombres',
        'sexo',
        'tipo_participacion',
        'titulo',
        'ruc_empresa',
        'nombre_empresa',
        'id_pregunta',
        'id_usuario'
    ];

    protected $useTimestamps = false;
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}
