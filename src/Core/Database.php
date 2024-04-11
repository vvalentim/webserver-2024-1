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
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
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

    public function findAll(): array {
        return $this->statement->fetchAll();
    }

    public function find(): mixed {
        return $this->statement->fetch();
    }
}