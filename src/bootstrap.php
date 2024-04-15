<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Helpers;

$container = new Container();

$container->bind("Core\Database", function () {
    $config = require(Helpers::getPath("base")."/config.php");
    $use_db = $config["use_db"];

    return Database::getInstance($config[$use_db], [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    ]);
});

App::setContainer($container);