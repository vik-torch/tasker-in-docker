<?php

namespace App\Repositories;

use PDO;

use Core\Database\MySQL\Repository;

class TestRepository extends Repository implements ITestRepository
{
    private const LIMIT = 10;

    public function create($data)
    {
        $response = $this->dbh->prepare('INSERT INTO test (name) VALUES (:name)');
        $response->execute($data);

        return $response;
    }

    public function find($id)
    {
        $query = $this->dbh->prepare('SELECT * FROM test WHERE id = :id');
        $query->execute(['id' => $id]);
        $response = $query->fetch(PDO::FETCH_ASSOC);

        return $response;
    }

    public function findByOffset(int $page_num)
    {
        $offset = $page_num * self::LIMIT;
        $response = $this->dbh->query('SELECT * FROM test LIMIT 10 OFFSET ' . $offset)->fetchAll(PDO::FETCH_ASSOC);
        
        return $response;
    }
}