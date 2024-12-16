<?php

namespace App\Controllers\Task;

use App\Middleware\Auth\Authorisation;
use Core\Response\SuccessResponse;
use GrahamCampbell\ResultType\Success;

class GetController extends BaseController
{
    public function index()
    {
        return $this->view::render('tasks/index');
    }

    public function getCollect()
    {
        $offset = (int)$_POST['page'] ?? 1;
        $offset = $offset < 1 ? 1 : $offset;
        
        $sort_by = $_POST['sort_by'] ?? null;
        $order = $_POST['order'] ?? null;
        
        $tasks = $this->taskService->getAll($offset, $sort_by, $order);

        return new SuccessResponse($tasks);
    }
}