<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class EmpleadosSeeder extends Seeder
{
    public function run()
    {
        $encrypter = \Config\Services::encrypter();

        // id_departamento: 1=Administracion, 2=Ventas, 3=Sistemas, 4=Recursos Humanos
        $empleados = [
            ['clave' => 'ADM001', 'nombre' => 'Laura García Mendoza',    'fecha_nacimiento' => '1985-06-12', 'telefono' => '5551100001', 'email' => 'laura.garcia@empresa.com',    'id_departamento' => 1],
            ['clave' => 'ADM002', 'nombre' => 'Roberto Sánchez Torres',  'fecha_nacimiento' => '1979-11-28', 'telefono' => '5551100002', 'email' => 'roberto.sanchez@empresa.com', 'id_departamento' => 1],
            ['clave' => 'ADM003', 'nombre' => 'Patricia Flores Reyes',   'fecha_nacimiento' => '1991-03-05', 'telefono' => '5551100003', 'email' => 'patricia.flores@empresa.com',  'id_departamento' => 1],
            ['clave' => 'VEN001', 'nombre' => 'Carlos Ramírez Ortiz',    'fecha_nacimiento' => '1988-08-22', 'telefono' => '5552200001', 'email' => 'carlos.ramirez@empresa.com',  'id_departamento' => 2],
            ['clave' => 'VEN002', 'nombre' => 'Sofía López Hernández',   'fecha_nacimiento' => '1993-01-17', 'telefono' => '5552200002', 'email' => 'sofia.lopez@empresa.com',     'id_departamento' => 2],
            ['clave' => 'VEN003', 'nombre' => 'Miguel Ángel Cruz Vega',  'fecha_nacimiento' => '1986-09-30', 'telefono' => '5552200003', 'email' => 'miguel.cruz@empresa.com',     'id_departamento' => 2],
            ['clave' => 'VEN004', 'nombre' => 'Ana Beatriz Morales',     'fecha_nacimiento' => '1995-04-08', 'telefono' => '5552200004', 'email' => 'ana.morales@empresa.com',     'id_departamento' => 2],
            ['clave' => 'VEN005', 'nombre' => 'Javier Castillo Peña',   'fecha_nacimiento' => '1990-12-14', 'telefono' => '5552200005', 'email' => 'javier.castillo@empresa.com', 'id_departamento' => 2],
            ['clave' => 'SIS001', 'nombre' => 'Diego Martínez Ríos',     'fecha_nacimiento' => '1992-07-19', 'telefono' => '5553300001', 'email' => 'diego.martinez@empresa.com',  'id_departamento' => 3],
            ['clave' => 'SIS002', 'nombre' => 'Valeria Romero Aguilar',  'fecha_nacimiento' => '1994-02-25', 'telefono' => '5553300002', 'email' => 'valeria.romero@empresa.com',  'id_departamento' => 3],
            ['clave' => 'SIS003', 'nombre' => 'Eduardo Jiménez Ruiz',    'fecha_nacimiento' => '1987-10-03', 'telefono' => '5553300003', 'email' => 'eduardo.jimenez@empresa.com', 'id_departamento' => 3],
            ['clave' => 'SIS004', 'nombre' => 'Fernanda Guzmán Díaz',    'fecha_nacimiento' => '1996-05-11', 'telefono' => '5553300004', 'email' => 'fernanda.guzman@empresa.com', 'id_departamento' => 3],
            ['clave' => 'RH001',  'nombre' => 'Alejandra Vargas Lima',   'fecha_nacimiento' => '1983-08-16', 'telefono' => '5554400001', 'email' => 'alejandra.vargas@empresa.com','id_departamento' => 4],
            ['clave' => 'RH002',  'nombre' => 'Héctor Fuentes Molina',   'fecha_nacimiento' => '1980-04-27', 'telefono' => '5554400002', 'email' => 'hector.fuentes@empresa.com',  'id_departamento' => 4],
        ];

        foreach ($empleados as $empleado) {
            $empleado['telefono'] = base64_encode($encrypter->encrypt($empleado['telefono']));
            $this->db->table('empleados')->insert($empleado);
        }
    }
}
