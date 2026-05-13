<?php

namespace App\Controllers;

use Config\Database;
use Throwable;

class OpsMigrate extends BaseController
{
    public function run()
    {
        $enabled = (bool) env('ops.migrationEnabled', false);
        $token   = (string) $this->request->getGetPost('token');
        $secret  = (string) env('ops.migrationToken', '');

        if (! $enabled || $secret === '' || ! hash_equals($secret, $token)) {
            return $this->response->setStatusCode(403)->setJSON([
                'ok'      => false,
                'message' => 'Acceso denegado.',
            ]);
        }

        try {
            $runner = service('migrations');
            $runner->setNamespace(null);
            $runner->latest();

            $result = [
                'ok'      => true,
                'message' => 'Migraciones ejecutadas correctamente.',
            ];

            $runSeed = (string) $this->request->getGetPost('seed') === '1';

            if ($runSeed) {
                $db = db_connect();

                if ($db->tableExists('departamentos')) {
                    $count = $db->table('departamentos')->countAllResults();

                    if ($count === 0) {
                        Database::seeder()->call('DepartamentosSeeder');
                        $result['seed'] = 'DepartamentosSeeder ejecutado.';
                    } else {
                        $result['seed'] = 'Seeder omitido: departamentos ya tiene datos.';
                    }
                } else {
                    $result['seed'] = 'Seeder omitido: tabla departamentos no existe.';
                }

                if ($db->tableExists('empleados')) {
                    $count = $db->table('empleados')->countAllResults();

                    if ($count === 0) {
                        Database::seeder()->call('EmpleadosSeeder');
                        $result['seed_empleados'] = 'EmpleadosSeeder ejecutado.';
                    } else {
                        $result['seed_empleados'] = 'Seeder omitido: empleados ya tiene datos.';
                    }
                }
            }

            return $this->response->setJSON($result);
        } catch (Throwable $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'ok'      => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}