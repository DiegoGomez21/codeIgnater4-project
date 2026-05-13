<?php

namespace App\Libraries;

use Smarty\Smarty;


class SmartyRenderer
{
    private Smarty $smarty;

    public function __construct()
    {
        helper(['url', 'form']);

        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(APPPATH . 'Views/smarty/');
        $this->smarty->setCompileDir(WRITEPATH . 'smarty/compiled/');
        $this->smarty->setCacheDir(WRITEPATH . 'smarty/cache/');
        $this->smarty->caching = Smarty::CACHING_OFF;

        $this->registrarPlugins();
        $this->asignarFlashData();
    }


    public function assign(string $key, mixed $value): self
    {
        $this->smarty->assign($key, $value);

        return $this;
    }

    public function assignAll(array $data): self
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        return $this;
    }

    
    public function render(string $template): string
    {
        return $this->smarty->fetch($template . '.tpl');
    }


    private function registrarPlugins(): void
    {
        $this->smarty->registerPlugin('function', 'base_url', static function (array $params): string {
            return base_url($params['uri'] ?? '');
        });

        $this->smarty->registerPlugin('function', 'lang', static function (array $params): string {
            return (string) lang($params['key'] ?? '');
        });

        $this->smarty->registerPlugin('function', 'csrf_field', static function (): string {
            return csrf_field();
        });

        $this->smarty->registerPlugin('function', 'old', static function (array $params): string {
            return (string) old($params['key'] ?? '', $params['default'] ?? '');
        });

        $this->smarty->registerPlugin('function', 'old_select', static function (array $params): string {
            $oldVal = old($params['key'] ?? '', $params['current'] ?? '');

            return $oldVal == $params['value'] ? 'selected' : '';
        });
    }

    private function asignarFlashData(): void
    {
        $session = session();
        $this->smarty->assign('_mensaje', $session->getFlashdata('mensaje'));
        $this->smarty->assign('_error', $session->getFlashdata('error'));
        $this->smarty->assign('_errors', $session->getFlashdata('errors'));
        $this->smarty->assign('_usuarioAutenticado', auth()->loggedIn());
    }
}

