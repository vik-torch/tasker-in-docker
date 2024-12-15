<?php

namespace App\Models\Auth;

class UserModel
{
    public function __construct(
        public readonly string $login,
        public readonly string $password
    ) {}
}