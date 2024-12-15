<?php

namespace App\Services\Task;

use App\DTO\TasksDTO;

interface ITaskService
{
    public function create($text, $user_name, $user_email);
    public function getAll(int $page_num, $sort_by = null, $order = null): TasksDTO;
    public function update($id, $text, $status);
}