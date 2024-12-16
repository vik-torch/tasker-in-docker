<?php

namespace App\Migrations;

class Repository extends \Core\Database\MySQL\Repository
{
    public function upMigrations(string $sql): bool
    {
        $response = $this->dbh->query($sql);
        return $response ? true : false;
    }
}