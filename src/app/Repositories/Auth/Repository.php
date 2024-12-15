<?php

namespace App\Repositories\Auth;

use App\Models\Auth\UserModel;
use Core\Database\MySQL\Repository as MySQLRepository;

class Repository extends MySQLRepository implements IAuthRepository
{
    public function findBy(string $login)
    {
        $sth = $this->dbh->prepare('SELECT `id`, `login`, `password` FROM `auth_users` WHERE login = :login');
        $sth->execute(['login' => $login]);
        $response = $sth->fetch();

        return $response;
    }

    public function add(UserModel $userModel)
    {
        $response = $this->dbh->prepare('INSERT INTO `auth_users` (login, password) VALUES (:login, :password)');
        $response->execute([
            'login' => $userModel->login,
            'password' => $userModel->password
        ]);

        return $response;
    }
}