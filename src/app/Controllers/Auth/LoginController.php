<?php

namespace App\Controllers\Auth;

use App\Middleware\Auth\Authorisation;

class LoginController extends BaseController
{
    public function index()
    {
        if (Authorisation::check_session()) {
            header('Location: /tasks');
            return json_encode(['status' => '301', 'message' => 'Вы уже авторизованы! Ща как буудет редирект!!!']);
        }

        return $this->view::render('auth/login');
    }
}