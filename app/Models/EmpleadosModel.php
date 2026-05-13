<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
    protected $table            = 'empleados';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['clave', 'nombre', 'fecha_nacimiento', 'telefono', 'email', 'id_departamento', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getEmpleadosConDepartamento()
    {
        return $this->select('empleados.*, departamentos.nombre as departamento')
            ->join('departamentos', 'departamentos.id = empleados.id_departamento')
            ->orderBy('empleados.id', 'ASC')
            ->findAll();
    }
}
