<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind("Core\Database", function () {
    $config = [
        "dsn" => $_ENV["DB_DSN"],
        "username" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"],
    ];

    return Database::getInstance($config, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    ]);
});

App::setContainer($container);