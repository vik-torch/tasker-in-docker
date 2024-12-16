<?php

require_once __DIR__ . '/vendor/autoload.php';

try {
    // Загрузка переменных из файла .env
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    // $url = $_SERVER['REQUEST_URI'];
    $url = $_SERVER['REDIRECT_URL'] ?? $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];

    // Перенаправление запроса на роуты
    require_once __DIR__ . '/app/routes.php';

    echo $router->resolve($url, $method);
} catch (\Exception $e) {
    echo $e->getMessage();
}