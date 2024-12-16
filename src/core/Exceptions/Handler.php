<?php

namespace Core\Exceptions;

use Core\Response\ErrorResponse;

class Handler
{
    public static function handle(\Throwable $exception)
    {
        switch (true) {
            case ($exception instanceof IServerException):
            case ($exception instanceof \PDOException):
                http_response_code(500);
                return new ErrorResponse('', 500, 'Что-то пошло не так');
        }
        
        return $exception;
    }
}