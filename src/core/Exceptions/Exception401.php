<?php

namespace Core\Exceptions;

class Exception401 extends ClientException
{
    protected $code = 401;
    protected $message = 'Некорректные логин или пароль!';
}