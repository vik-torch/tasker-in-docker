<?php

namespace Core\View;

interface IView
{
    public static function render(string $view, $data = []): string;
}