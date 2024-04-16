<?php

namespace Core;

use PDO;
use PDOStatement;
use Throwable;

class Database {
    private static ?Database $instance = null;

    protected PDO $connection;

    protected PDOStatement $statement;

    private function __construct(
        array $config, 
        array $pdoOptions,
    ) {
        extract($config);
        
        try {
            $this->connection = new PDO($dsn, $username, $password, $pdoOptions);
        } catch (Throwable $e) {
            Helpers::abort(500, "Falha no servidor", "Ocorreu uma falha no servidor.");
        }
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

    public function getConnection(): PDO {
        return $this->connection;
    }

    public function runInTransaction(callable $callback): mixed {
        $result = null;

        try {
            $this->connection->beginTransaction();
            $result = call_user_func($callback);
            $this->connection->commit();
        } catch (Throwable $e) {
            $this->connection->rollBack();
            throw $e;
        }

        return $result;
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

    public function find(string $className = "", int $fetchMode = PDO::FETCH_DEFAULT): mixed {
        if (!empty($className)) {
            $this->statement->setFetchMode(PDO::FETCH_CLASS, $className);
        }

        return $this->statement->fetch();
    }

    public function lastInsertId(): string|false {
        return $this->connection->lastInsertId();
    }

    public function count(): int {
        return $this->statement->rowCount();
    }
}