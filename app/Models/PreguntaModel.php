<?php

namespace App\Models;

class PreguntaModel extends \CodeIgniter\Model
{
    protected $table = 'pregunta';
    protected $primaryKey = 'id_pregunta';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_pregunta', 'contenido', 'dni_usuario', 'id_eje', 'fecha_registro'];

    protected $useTimestamps = false;
    protected $createdField  = 'fecha_registro';
    protected $dateFormat    = 'date';
    protected $updatedField  = false;
    
}
