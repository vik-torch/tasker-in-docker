<?php

namespace App\Migrations;

use Core\Exceptions\ServerException;
use Core\Response\ErrorResponse;
use Core\Response\SuccessResponse;

class Migration
{
    private Repository $repository;
    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function index()
    {
        $file_name = 'app/Migrations/tasker.sql';
        if (!file_exists($file_name)) {
            throw new ServerException('Некорректное имя миграции');
        }

        $migrations = file_get_contents('app/Migrations/tasker.sql');
        $response = $this->repository->upMigrations($migrations);

        return $response ? new SuccessResponse('Успешная миграция!') : new ErrorResponse('Неудачная миграция!');
    }

}