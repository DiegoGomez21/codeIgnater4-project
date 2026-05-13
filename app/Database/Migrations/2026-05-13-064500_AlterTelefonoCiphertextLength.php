<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTelefonoCiphertextLength extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('empleados', [
            'telefono' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('empleados', [
            'telefono' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
            ],
        ]);
    }
}
