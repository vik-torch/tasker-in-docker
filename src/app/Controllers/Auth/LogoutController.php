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
        return $this->view::render('auth.login');
    }
}