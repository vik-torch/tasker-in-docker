<?php

namespace App\Services\Auth;

use App\Middleware\Auth\Authorisation;
use App\Middleware\Auth\SessionDTO;
use App\Models\Auth\UserModel;
use App\Repositories\Auth\IAuthRepository;
use App\Repositories\Auth\Repository;
use Core\Exceptions\ClientException;
use Core\Exceptions\ServerException;

class AuthService implements IAuthService
{
    private IAuthRepository $authRepository;

    public function __construct()
    {
        $this->authRepository = new Repository();
    }

    public function find(UserModel $userModel): array|false
    {
        $login = $userModel->login;
        $response = $this->authRepository->findBy($login);

        return $response;
    }

    public function register(UserModel $userModel)
    {
        $is_exists = $this->find($userModel);
        if ($is_exists) {
            throw new ClientException('Пользователь с таким логином уже существует', 403);
        }

        $response = $this->authRepository->add($userModel);

        return $response;
    }

    public function auth($data)
    {
        if ($data && isset($data['id'])) {
            $session_dto = new SessionDTO($data['id']);
            Authorisation::set_session($session_dto);
            setcookie('auth_id', $session_dto->id, time() + 3600, '/');
        } else {
            throw new ServerException('Ошибка авторизации');
        }
    }
}