<?php

namespace App\Controllers;

use App\Services\ITestService;
use App\Services\TestService;

class TestController extends Controller
{
    private ITestService $testService;

    public function __construct()
    {
        $this->testService = new TestService();
    }

    public function index()
    {
        return "I`m TestController!!!";
    }
    
    public function findFirst()
    {
        $test_model = $this->testService->getById(1);    

        return json_encode($test_model);
    }
}