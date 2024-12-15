<?php

namespace App\Services;

use App\Models\Test as TestModel;
use App\Repositories\ITestRepository;
use App\Repositories\TestRepository;

class TestService implements ITestService
{
    private ITestRepository $repository;

    public function __construct()
    {
        $this->repository = new TestRepository();
    }
    public function getById(int $id): TestModel
    {
        $response = $this->repository->find($id);
        
        $test_model = new TestModel(
            $response['id'],
            $response['name'],
            $response['scores']
        );

        return $test_model;
    }
}