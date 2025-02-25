<?php 

namespace App\Models;

class RendicionModel extends \CodeIgniter\Model
{
    protected $table = 'rendición';
    protected $primaryKey = 'id_rendicion';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['id_rendicion', 'fecha','hora_rendicion'];

    protected $useTimestamps = false;
    protected $updatedField  = false;
    
}