<?php

namespace App\Controllers\Auth;

use App\Services\Auth\AuthService;
use App\Services\Auth\IAuthService;
use Core\Controller\Controller as ControllerController;

class BaseController extends ControllerController
{
    protected IAuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }
}