<?php

namespace Core;

class Request
{
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function validate(&$param)
    {
        return htmlspecialchars($param);
    }
}