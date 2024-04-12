<?php

namespace Core;

use PDO;
use PDOStatement;

class Database {
    private static ?Database $instance = null;
    protected PDO $connection;
    protected PDOStatement $statement;

    private function __construct(array $config) {
        extract($config);

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    }

    public static function getInstance($config) {
        if (static::$instance === null) {
            static::$instance = new self($config);
        }

        return static::$instance;
    }

    public function query(string $query, array $values): Database {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($values);

        return $this;
    }

    public function findAll(string $className = ""): array {
        if (!empty($className)) {
            $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);
        }

        return $this->statement->fetchAll();
    }

    public function find(string $className = ""): mixed {
        if (!empty($className)) {
            $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);
        }

        return $this->statement->fetch();
    }
}