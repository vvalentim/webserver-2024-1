<?php

namespace Core;

use Core\Exceptions\PostgresExceptionCodes;
use PDO;

class Database {
    private static ?Database $instance = null;

    public readonly PDO $connection;

    private function __construct(array $config, array $pdoOptions) {
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
}