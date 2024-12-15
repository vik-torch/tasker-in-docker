<?php

namespace App\DTO;

class TaskDTO
{
    public function __construct(
        public int $id,
        public string $text,
        public string $status,
        public string $user_name,
        public string $user_email
    ) {}
}