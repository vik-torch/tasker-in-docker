<?php

namespace Core\Route;

use Core\Exceptions\ServerException;

class Track implements ITrack
{
    public string $action;
    public string $controller;

    public function __construct($controller, $action)
    {
        $this->action = $action;
        $this->controller = $controller;
    }

    public function run(): string
    {
        $controller = new $this->controller();
        
        if (!method_exists($controller, $this->action)) {
            throw new ServerException();
        }
        
        $response = $controller->{$this->action}();
        
        return $response;
    }
}