<?php

namespace App\Repositories\User;

use App\Models\IUserModel;
use App\Models\User;
use Core\Database\MySQL\IRepository;

interface IUserRepository extends IRepository
{
    public function create(IUserModel $user);
    public function find(int $id);
    public function findIdBy(string $email);
    public function findBy(string $email);
}