<?php

namespace App\Controllers\Auth;

use App\Middleware\Auth\Authorisation;
use App\Models\Auth\UserModel as User;
use Core\Exceptions\Exception401;

class AuthController extends BaseController
{
    public function index()
    {
        if (Authorisation::check_session()) {
            header('Location: /task');
            exit;
        }
        
        $login = trim($_POST['login']) ?? null;
        $password = trim($_POST['password']) ?? null;

        if (!$login && !$password) {
            throw new Exception401();
        }
        $user_model = new User($login, $password);
        $user = $this->authService->find($user_model);

        $is_password_valid = password_verify($password, $user['password']);
        if (!$is_password_valid) {
            throw new Exception401();
        }

        if ($user && isset($user['id'])) {
            $this->authService->auth($user);
            // TODO: Добавить редирект
            // return $this->view::render('auth.login');
            return json_encode(['status' => '200', 'message' => 'Успешная авторизация!']);
        }

        return json_encode(['status' => '401', 'message' => 'Неправильный логин или пароль!']);
    }
}