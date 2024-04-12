<?php

namespace Core;

use PDO;
use PDOStatement;

class Database {
    private static ?Database $instance = null;
    protected PDO $connection;
    protected PDOStatement $statement;

    private function __construct(
        array $config, 
        array $pdoOptions,
    ) {
        extract($config);

        $this->connection = new PDO($dsn, $username, $password, $pdoOptions);
    }

    public static function getInstance(
        array $config,
        array $pdoOptions = [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ],
    ) {
        if (static::$instance === null) {
            static::$instance = new self($config, $pdoOptions);
        }

        return static::$instance;
    }

    public function query(string $query, array $values): Database {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($values);

        return $this;
    }

    public function buildUpdateQuery(string $table, array $fields, bool $enablePkChange = false): string {
        // Prevents the primary key from being updated
        if (!$enablePkChange) {
            unset($dto["id"]);
        }

        $fields = array_map(fn($field) => "{$field} = :{$field}", $fields);

        return "UPDATE {$table} SET ".join(",", $fields);
    }

    public function count(): int {
        return $this->statement->rowCount();
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