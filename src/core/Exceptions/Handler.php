<?php

namespace Core\Exceptions;

use Core\Response\ErrorResponse;

class Handler
{
    public static function handle(\Throwable $exception)
    {
        if ($exception instanceof IServerException) {
            http_response_code($exception->getCode());
            return new ErrorResponse('', $exception->getCode(), 'Что-то пошло не так');
        }
        return $exception;
    }
}