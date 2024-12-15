<?php

namespace Core\Response;

class ErrorResponse extends Response
{
    public function __construct(
        private $content = null,
        private int $status = 500,
        private string $message = ''
    ) {
        parent::__construct($content, $status, $message);
    }
}