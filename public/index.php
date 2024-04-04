<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors", true);

require_once(__DIR__."/../src/autoload.php");
require_once(__DIR__."/../src/bootstrap.php");
require_once(__DIR__."/../src/routes.php");

$uri = urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($method, $uri);