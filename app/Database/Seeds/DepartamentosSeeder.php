<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DepartamentosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nombre'      => 'Administracion',
                'descripcion' => 'Gestion administrativa de la empresa',
            ],
            [
                'nombre'      => 'Ventas',
                'descripcion' => 'Atencion comercial y ventas',
            ],
            [
                'nombre'      => 'Sistemas',
                'descripcion' => 'Soporte tecnico y desarrollo',
            ],
            [
                'nombre'      => 'Recursos Humanos',
                'descripcion' => 'Gestion del personal',
            ],
        ];

        $this->db->table('departamentos')->insertBatch($data);
    }
}
