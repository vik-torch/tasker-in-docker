<?php

namespace App\Services\Auth;

use App\Middleware\Auth\SessionDTO;
use App\Models\Auth\UserModel;

interface IAuthService
{
    public function find(UserModel $user_model);
    public function register(UserModel $user_model);
    public function auth($data);
}