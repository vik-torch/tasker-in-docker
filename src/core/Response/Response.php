<?php

namespace Core\Response;

abstract class Response
{
    public function __construct(
        private $content = null,
        private int $status = 200,
        private string $message = ''
    ) {
        header('Content-Type: application/json');
    }

    public function __toString()
    {
        return json_encode([
            'data' => $this->content,
            'status' => $this->status
        ]);
    }
}