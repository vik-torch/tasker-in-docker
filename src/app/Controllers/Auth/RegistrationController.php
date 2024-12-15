<?php

namespace App\Controllers\Auth;

use App\Models\Auth\UserModel;

class RegistrationController extends BaseController
{
    public function index()
    {
        $login = 'admin';
        $password = password_hash('123', PASSWORD_DEFAULT);
        $admin = new UserModel($login, $password);

        $response = $this->authService->register($admin);

        if ($response) {
            return json_encode(['status' => '201', 'message' => 'Успешная регистрация!']);
        } else {
            throw new \Exception('Ошибка регистрации', 401);
        }
    }
}