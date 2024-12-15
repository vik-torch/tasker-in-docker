<?php

namespace App\Repositories;

use Core\Database\MySQL\IRepository;

interface ITestRepository extends IRepository
{
    public function create($data);
    public function find(int $id);
    public function findByOffset(int $page_num);
}