<?php

namespace App\Controllers;

class FirstController extends Controller
{
    public function index(): string
    {
        $name = 'Viktor';
        $comp = compact('name');
        $response = $this->view::render('first', compact('name'));
        return $response;
    }
}