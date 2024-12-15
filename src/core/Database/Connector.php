<?php

namespace Core\Database;

use \PDO;

class Connector
{
    private static $instance = null;
    public PDO $connection;

    private function __construct()
    {
        $this->connection = self::getConnection();
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Connector();
        }
        return self::$instance;
    }
    
    private static function getConnection(): PDO
    {
        $options =[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        
        $connection = new PDO(
            'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_NAME'],
            $_ENV['DB_USER'],
            $_ENV['DB_PASS'],
            $options
        );

        return $connection;
    }
}