<?php

declare(strict_types=1);

class AdminAuthController extends Controller
{
    public function redirectLogin(): void
    {
        $this->redirect('/admin/login');
    }

    public function loginForm(): void
    {
        if (Auth::check()) {
            $this->redirect('/admin/dashboard');
        }
        $this->view('admin/login');
    }

    public function login(): void
    {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

        if (LoginAttempt::isBlocked($ip)) {
            $_SESSION['login_error'] = 'Muitas tentativas. Aguarde 15 minutos.';
            $this->redirect('/admin/login');
        }

        Csrf::verify();

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $user     = User::findByEmail($email);

        if (!$user || !User::verifyPassword($password, $user['password'])) {
            LoginAttempt::record($ip);
            $_SESSION['login_error'] = 'E-mail ou senha incorretos.';
            $this->redirect('/admin/login');
        }

        LoginAttempt::clear($ip);
        Auth::login((int) $user['id']);
        $this->redirect('/admin/dashboard');
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirect('/admin/login');
    }
}
