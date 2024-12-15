<?php

namespace Core\Exceptions;

class ClientException extends \Exception
{
    protected $code = 400;
    protected $message = 'Bad request';
}