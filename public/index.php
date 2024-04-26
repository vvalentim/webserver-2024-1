<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors", true);

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/../src/bootstrap.php");
require_once(__DIR__."/../src/routes.php");
require_once(__DIR__."/../src/simplerouter.helpers.php");

use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::start();