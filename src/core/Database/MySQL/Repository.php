<?php

namespace Core\Database\MySQL;

use Core\Database\Connector;
use Core\Database\MySQL\IRepository;
use PDO;

/**
 * Summary of Repository
 * 
 * @method void beginTransaction()
 */
abstract class Repository implements IRepository
{
    /**
     * DB Handler
     * @var PDO
     */
    protected PDO $dbh;

    public function __construct()
    {
        $this->dbh = Connector::getInstance()->connection;
    }
    
    /**
     * Начало транзакции
     * @return void
     */
    public function beginTransaction()
    {
        $this->dbh->beginTransaction();
    }

    /**
     * Окончание транзакции
     * @return void
     */
    public function commit()
    {
        $this->dbh->commit();
    }

    public function rollBack()
    {
        $this->dbh->rollBack();
    }
}