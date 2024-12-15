<?php

namespace Core\Route;

class Router
{
    /**
     * Массив роутов
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Добавление роута
     * 
     * @param string $method - http метод
     * @param string $uri - url
     * @param string $controller - имя контроллера (класса)
     * @param string $action - имя экшена (метода) контроллера
     * @return void
     */
    public function addRoute(
        string $method,
        string $uri,
        string $controller,
        string $action
    ) {
        $this->routes[$method][$uri] = new Track($controller, $action);
    }

    public function resolve(string $uri, string $method)
    {
        $this->checkMethod($method);
        if (!isset($this->routes[$method][$uri])) {
            throw new \Exception('Страница не найдена');
        }
        $track = $this->getTrack($method, $uri);

        return $track->run();
    }

    private function getTrack($method, $uri): ITrack
    {
        return $this->routes[$method][$uri];
    }

    private function checkMethod($method)
    {
        if (!isset($this->routes[$method])) {
            throw new \Exception('Неверный HTTP-метод');
        }
    }
}