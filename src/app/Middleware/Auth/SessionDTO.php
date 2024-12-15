<?php

namespace App\Middleware\Auth;

class SessionDTO
{
    public function __construct(
        public $id
    ) {}
}