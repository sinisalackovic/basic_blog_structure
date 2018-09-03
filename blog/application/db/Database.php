<?php

namespace Db;

use Core\Constants;

class Database
{
    private $connection;

    /**
     * @var \PDO
     */
    private static $instance;

    /**
     * Database constructor.
     */
    private function __construct()
    {
        try {
            // Remove db credentials to a config file to protect data
            $this->connection = new \PDO(
                Constants::DB_DSN,
                Constants::DB_USERNAME,
                Constants::DB_PASSWORD,
                []
            );
        } catch (\PDOException $e) {
            die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
        }
    }

    /**
     * @return Database
     */
    public static function getInstance()
    {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param $statement
     * @return string
     */
    public function query($statement)
    {
        return $this->connection->query($statement);
    }

    /**
     * @param $statement
     * @return bool
     */
    public function execute($statement)
    {
        return $this->connection->query($statement)->execute();
    }

    public function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    // Magic method clone is empty to prevent duplication of connection
    private function __clone(){}
}
