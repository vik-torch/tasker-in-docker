<?php

namespace App\Repositories\Auth;

use App\Models\Auth\UserModel;

interface IAuthRepository
{
    public function findBy(string $login);
    public function add(UserModel $userModel);
}