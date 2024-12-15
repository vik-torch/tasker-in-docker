<?php

namespace App\Models;

class Test
{
    public function __construct(
        public int $id,
        public string $name,
        public int $scores
    ) {}
}