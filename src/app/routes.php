<?php

use App\Controllers\Auth\AuthController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\LogoutController;
use App\Controllers\Auth\RegistrationController;
use Core\Route\Router;
use App\Controllers\HelloController;
use App\Controllers\FirstController;
use App\Controllers\TestController;
use App\Controllers\Task\GetController;
use App\Controllers\Task\StoreController;
use App\Controllers\Task\UpdateController;

/**
 * Файл с добавлением роутов
 */

$router = new Router();

$router->addRoute('GET', '/', HelloController::class, 'index');
$router->addRoute('GET', '/first', FirstController::class, 'index');

$router->addRoute('GET', '/test', TestController::class, 'index');
$router->addRoute('GET', '/test/first', TestController::class, 'findFirst');

//////////////////////////////////////////////
////////
// Task
////////
$router->addRoute('GET', '/tasks', GetController::class, 'index');
$router->addRoute('POST', '/tasks', GetController::class, 'getCollect');
$router->addRoute('POST', '/tasks/store', StoreController::class, 'index');
$router->addRoute('POST', '/tasks/update', UpdateController::class, 'index');

// Auth
$router->addRoute('POST', '/registration', RegistrationController::class, 'index');
$router->addRoute('GET', '/login', LoginController::class, 'index');
$router->addRoute('GET', '/logout', LogoutController::class, 'index');
$router->addRoute('POST', '/login/auth', AuthController::class, 'index');