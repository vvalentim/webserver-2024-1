<?php

namespace Core;

use PDO;

class Database {
    protected $connection;

    public function __construct($config) {
        extract($config);

        $dsn = "{$driver}:host={$host};port={$port};dbname={$dbname};";
        
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
}