<?php

namespace App\Controllers;

use App\Libraries\SmartyRenderer;
use CodeIgniter\Shield\Models\UserIdentityModel;
use CodeIgniter\Shield\Models\UserModel;

class AuthController extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function loginView(?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $data = [
            'titulo'       => lang('Auth.login'),
            'localeActual' => $this->localeActual($locale),
            'rutaBase'     => $this->rutaBase($locale),
        ];

        return (new SmartyRenderer())->assignAll($data)->render('auth/login');
    }

    public function loginAction(?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            $identityModel = model(UserIdentityModel::class);
            $identity = $identityModel
                ->where('user_id', $user->id)
                ->where('type', 'email_password')
                ->first();

            if ($identity && service('passwords')->verify($password, $identity->secret2)) {
                auth()->login($user);
                session()->regenerate();
                return redirect()->to($this->rutaBase($locale))->with('mensaje', lang('Auth.successLogin'));
            }
        }

        return redirect()->back()->withInput()->with('error', lang('Auth.invalidAttempt'));
    }

    public function registerView(?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $data = [
            'titulo'       => lang('Auth.register'),
            'localeActual' => $this->localeActual($locale),
            'rutaBase'     => $this->rutaBase($locale),
        ];

        return (new SmartyRenderer())->assignAll($data)->render('auth/register');
    }

    public function registerAction(?string $locale = null)
    {
        $this->aplicarLocale($locale);

        $rules = [
            'username' => 'required|string|min_length[3]|max_length[30]',
            'email'    => 'required|valid_email',
            'password' => 'required|string|min_length[8]',
            'confirm_password' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();
        $identityModel = model(UserIdentityModel::class);

        if ($userModel->where('username', $username)->first()) {
            return redirect()->back()->withInput()->with('errors', ['username' => lang('Auth.usernameTaken')]);
        }

        if ($identityModel->where('type', 'email_password')->where('secret', $email)->first()) {
            return redirect()->back()->withInput()->with('errors', ['email' => lang('Auth.emailTaken')]);
        }

        try {
            $user = $userModel->createNewUser([
                'username' => $username,
                'email'    => $email,
                'password' => $password,
            ]);

            $userModel->save($user);
            $user = $userModel->find($userModel->getInsertID());

            if (!$user) {
                return redirect()->back()->withInput()->with('error', lang('Auth.errorCreatingUser'));
            }

            $user->active = 1;
            $userModel->save($user);

            auth()->login($user);
            session()->regenerate();

            return redirect()->to($this->rutaBase($locale))->with('mensaje', lang('Auth.successRegister'));
        } catch (\Throwable $e) {
            return redirect()->back()->withInput()->with('error', lang('Auth.errorCreatingUser'));
        }
    }

    public function logoutAction(?string $locale = null)
    {
        $this->aplicarLocale($locale);

        auth()->logout();
        session()->destroy();

        return redirect()->to('login')->with('mensaje', lang('Auth.successLogout'));
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
}
