<?php

namespace App\Controllers\Task;

use App\Services\Task\Service;
use App\Services\Task\ITaskService;
use Core\Controller\Controller;

class BaseController extends Controller
{
    protected ITaskService $taskService;

    public function __construct()
    {
        parent::__construct();
        $this->taskService = new Service();
    }
}