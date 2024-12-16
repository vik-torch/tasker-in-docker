<?php

namespace App\Controllers\Auth;

use App\Middleware\Auth\Authorisation;

class LogoutController extends BaseController
{    
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        Authorisation::end_session();
        setcookie('auth_id', '', -1, '/');
        header('Location: /tasks');
        return $this->view::render('/tasks/index');
    }
}