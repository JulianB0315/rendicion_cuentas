<?php

namespace App\Models;

class Preguntas_seleccionadasModel extends \CodeIgniter\Model
{
    protected $table = 'preguntas_seleccionadas';
    protected $primaryKey = 'id_pregunta_seleccionada';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_pregunta_seleccionada', 'id_eje_seleccionado', 'id_pregunta'];
    
    protected $useTimestamps = false;
    protected $updatedField  = false;
    
}