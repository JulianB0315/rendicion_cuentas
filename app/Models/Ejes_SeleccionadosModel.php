<?php

namespace App\Models;

class Ejes_SeleccionadosModel extends \CodeIgniter\Model
{
    protected $table = 'ejes_seleccionados';
    protected $primaryKey = 'id_eje_seleccionado';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'id_eje_seleccionado',
        'id_rendicion',
        'id_eje',
        'cantidad_preguntas'
    ];


    protected $useTimestamps = false;
    protected $updatedField  = false;
}
