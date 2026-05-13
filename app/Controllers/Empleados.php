<?php

namespace App\Controllers;

use App\Libraries\SmartyRenderer;
use App\Models\DepartamentosModel;
use App\Models\EmpleadosModel;

class Empleados extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function index(?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $model = new EmpleadosModel();
        $empleados = $model->getEmpleadosConDepartamento();
        $encrypter = service('encrypter');

        foreach ($empleados as &$empleado) {
            $valor = (string) $empleado['telefono'];
            $binario = base64_decode($valor, true);

            if ($binario !== false) {
                try {
                    $empleado['telefono'] = (string) $encrypter->decrypt($binario);
                } catch (\Throwable) {
                    $empleado['telefono'] = $valor;
                }
            } else {
                $empleado['telefono'] = $valor;
            }
        }

        unset($empleado);

        $data = [
            'titulo'      => lang('App.employees'),
            'empleados'   => $empleados,
            'rutaBase'    => $this->rutaBase($locale),
            'localeActual'=> $this->localeActual($locale),
        ];

        return $this->smartyView('empleados/index', $data);
    }

    public function new(?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $departamentosModel = new DepartamentosModel();

        $data = [
            'titulo'        => lang('App.newEmployee'),
            'departamentos' => $departamentosModel->findAll(),
            'rutaBase'      => $this->rutaBase($locale),
            'localeActual'  => $this->localeActual($locale),
        ];

        return $this->smartyView('empleados/nuevo', $data);
    }

    public function create(?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $rules = [
            'clave'             => 'required|max_length[10]|is_unique[empleados.clave]',
            'nombre'            => 'required|max_length[100]',
            'fecha_nacimiento'  => 'required|valid_date',
            'telefono'          => 'required|max_length[20]',
            'email'             => 'required|max_length[100]|valid_email',
            'id_departamento'   => 'required|is_natural_no_zero',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new EmpleadosModel();
        $model->insert($this->datosEmpleado());

        return redirect()->to(base_url($this->rutaBase($locale)))->with('mensaje', lang('App.employeeCreated'));
    }

    public function edit($id = null, ?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $model = new EmpleadosModel();
        $departamentosModel = new DepartamentosModel();
        $empleado = $model->find($id);

        if ($empleado === null) {
            return redirect()->to(base_url($this->rutaBase($locale)))->with('error', lang('App.employeeNotFound'));
        }

        $valor = (string) $empleado['telefono'];
        $binario = base64_decode($valor, true);

        if ($binario !== false) {
            try {
                $empleado['telefono'] = (string) service('encrypter')->decrypt($binario);
            } catch (\Throwable) {
                $empleado['telefono'] = $valor;
            }
        } else {
            $empleado['telefono'] = $valor;
        }

        $data = [
            'titulo'        => lang('App.editEmployee'),
            'empleado'      => $empleado,
            'departamentos' => $departamentosModel->findAll(),
            'rutaBase'      => $this->rutaBase($locale),
            'localeActual'  => $this->localeActual($locale),
        ];

        return $this->smartyView('empleados/editar', $data);
    }

    public function update($id = null, ?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $id = (int) $id;

        $rules = [
            'clave'             => "required|max_length[10]|is_unique[empleados.clave,id,{$id}]",
            'nombre'            => 'required|max_length[100]',
            'fecha_nacimiento'  => 'required|valid_date',
            'telefono'          => 'required|max_length[20]',
            'email'             => 'required|max_length[100]|valid_email',
            'id_departamento'   => 'required|is_natural_no_zero',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $model = new EmpleadosModel();
        $model->update($id, $this->datosEmpleado());

        return redirect()->to(base_url($this->rutaBase($locale)))->with('mensaje', lang('App.employeeUpdated'));
    }

    public function delete($id = null, ?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $model = new EmpleadosModel();
        $model->delete($id);

        return redirect()->to(base_url($this->rutaBase($locale)))->with('mensaje', lang('App.employeeDeleted'));
    }

    private function datosEmpleado()
    {
        $telefono = (string) $this->request->getPost('telefono');

        return [
            'clave'             => $this->request->getPost('clave'),
            'nombre'            => $this->request->getPost('nombre'),
            'fecha_nacimiento'  => $this->request->getPost('fecha_nacimiento'),
            'telefono'          => base64_encode(service('encrypter')->encrypt($telefono)),
            'email'             => $this->request->getPost('email'),
            'id_departamento'   => $this->request->getPost('id_departamento'),
        ];
    }

    private function aplicarLocale(?string $locale): void
    {
        $locale = $this->localeActual($locale);
        service('request')->setLocale($locale);
        service('language')->setLocale($locale);
    }

    private function localeActual(?string $locale): string
    {
        return in_array($locale, ['es', 'en'], true) ? $locale : 'es';
    }

    private function rutaBase(?string $locale): string
    {
        return $this->localeActual($locale) === 'en' ? 'en/employees' : 'es/empleados';
    }

    private function smartyView(string $template, array $data): string
    {
        return (new SmartyRenderer())->assignAll($data)->render($template);
    }
}

