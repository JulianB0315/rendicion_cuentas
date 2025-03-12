<?

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
}

?>