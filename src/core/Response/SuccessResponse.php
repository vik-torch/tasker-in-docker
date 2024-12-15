<?php

namespace Core\Response;

class SuccessResponse extends Response
{
    public function __construct(
        private $content = null,
        private int $status = 200,
        private string $message = ''
    ) {
        parent::__construct($content, $status, $message);
    }
}