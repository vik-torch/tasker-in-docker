<?php

namespace Core\Controller;

use Core\View\IView;
use Core\View\View;

class Controller
{
    /**
     * View instance
     *
     * @var IView
     */
    protected IView $view;

    public function __construct()
    {
        $this->view = new View();
    }
}