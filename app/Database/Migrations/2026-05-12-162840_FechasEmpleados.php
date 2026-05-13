<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FechasEmpleados extends Migration
{
    public function up()
    {
        $this->forge->addColumn('empleados', [
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('empleados', 'created_at');
        $this->forge->dropColumn('empleados', 'updated_at');
    }
}
