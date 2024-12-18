<?php

namespace App\Controllers\Auth;

use App\Middleware\Auth\Authorisation;
use App\Models\Auth\UserModel as User;
use Core\Response\ErrorResponse;
use Core\Response\SuccessResponse;

class AuthController extends BaseController
{
    public function index()
    {
        if (Authorisation::check_session()) {
            return new SuccessResponse(
                json_encode(['url' => '/tasks']), 
                300,
                'Вы уже авторизованы!'
            );
        }
        
        $login = trim($_POST['login']) ?? null;
        $password = trim($_POST['password']) ?? null;

        if (!$login && !$password) {
            // throw new Exception401();
            return new ErrorResponse('', 401, 'Неправильный логин или пароль!');
        }
        $user_model = new User($login, $password);
        $user = $this->authService->find($user_model);
        
        if (!$user) {
            return new ErrorResponse('', 401, 'Неправильный логин или пароль!');
        }

        $is_password_valid = password_verify($password, $user['password']);
        if (!$is_password_valid) {
            return new ErrorResponse('', 401, 'Неправильный логин или пароль!');
        }

        if (!isset($user['id'])) {
            return new ErrorResponse('', 401, 'Неправильный логин или пароль!');
        }

        $this->authService->auth($user);
        // TODO: Добавить редирект
        // return $this->view::render('auth.login');
        return new SuccessResponse('', 300, 'Успешная авторизация!');
    }
}