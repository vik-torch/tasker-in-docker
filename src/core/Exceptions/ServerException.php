<?php

namespace Core\Exceptions;

class ServerException extends \Exception implements IServerException
{
    protected $code = 500;
    protected $message = 'Server error';
}