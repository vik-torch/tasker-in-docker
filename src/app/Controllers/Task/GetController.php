<?php

namespace App\Controllers\Task;

use App\Middleware\Auth\Authorisation;
use Core\Response\SuccessResponse;
use GrahamCampbell\ResultType\Success;

class GetController extends BaseController
{
    public function index()
    {
        // $is_auth = Authorisation::check_session();
        
        // $offset = (int)$_GET['page'] ?? 1;
        // $offset = $offset < 1 ? 1 : $offset;
        
        // $sort_by = $_GET['sort_by'] ?? null;
        // $order = $_GET['order'] ?? null;
        
        // $tasks = $this->taskService->getAll($offset, $sort_by, $order);

        // return $this->view::render('tasks/index', compact('tasks'));
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