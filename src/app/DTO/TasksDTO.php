<?php

namespace App\DTO;

class TasksDTO
{
    /**
     * Summary of __construct
     * @param TaskDTO[] $tasks
     * @param int $total_count
     * @param int $page_num
     */
    public function __construct(
        public array $tasks,
        public int $total_count,
        public int $page_num
    ) {}
}