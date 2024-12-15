<?php

namespace Core\View;

class View implements IView
{
    protected const VIEW_PATH = 'resources/views/';

    public static function render(string $view, $data = []): string
    {
        extract($data);
        ob_start();
        include static::VIEW_PATH . $view . '.php';
        return ob_get_clean() ?? null;
    }
}