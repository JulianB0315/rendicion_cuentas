<?php

namespace App\Models;

class EjeModel extends \CodeIgniter\Model
{
    protected $table = 'eje';
    protected $primaryKey = 'id_eje';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_eje', 'tematica'];

    protected $useTimestamps = false;
    protected $updatedField  = false;
    
}