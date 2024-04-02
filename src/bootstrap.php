<?php

use Core\App;
use Core\Container;
use Core\Database;
use Core\Helpers;

$container = new Container();

$container->bind('Core\Database', function () {
    $config = require(Helpers::getPath("base")."/config.php");

    return new Database($config['db_local']);
});

App::setContainer($container);