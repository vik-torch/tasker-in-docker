<?php

namespace App\Repositories\User;

use App\Models\IUserModel;
use App\Models\User;
use Core\Database\MySQL\Repository as MySQLRepository;

class Repository extends MySQLRepository implements IUserRepository
{
    public function create(IUserModel $user)
    {
        $sth = $this->dbh->prepare(
            'INSERT INTO `users`
                (`name`, `email`)
                VALUES (:name, :email)'
        );
        $sth->execute([
            ':name' => $user->getName(),
            ':email' => $user->getEmail(),
        ]);

        $user_id = $this->dbh->lastInsertId();

        return $user_id;
    }

    public function find(int $id)
    {
        // TODO: Implement find() method.
    }

    public function findIdBy(string $email)
    {
        $sth = $this->dbh->prepare('SELECT `id` FROM users WHERE email = :email');
        $sth->execute(['email' => $email]);
        $response = $sth->fetch();

        return $response === false ? $response : $response['id'];
    }

    public function findBy(string $email)
    {
        $sth = $this->dbh->prepare('SELECT `id`,`name`,`email` FROM users WHERE email = :email');
        $sth->execute(['email' => $email]);
        $response = $sth->fetch();

        return $response;
    }
}