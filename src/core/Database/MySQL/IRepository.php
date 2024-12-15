<?php

namespace Core\Database\MySQL;

use \Core\Database\IRepository as IBaseRepository;

interface IRepository extends IBaseRepository
{
    public function beginTransaction();
    public function commit();
    public function rollBack();
}