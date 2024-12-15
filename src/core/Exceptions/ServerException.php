<?php

namespace Core\Exceptions;

class ServerException extends \Exception
{
    protected $code = 500;
    protected $message = 'Server error';
}