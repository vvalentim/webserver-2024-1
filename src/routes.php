<?php

use Core\Router;

$router = new Router();

// Routes definition
$router->get("/login", Controllers\Dashboard\Login::class);
$router->post("/login", Controllers\Dashboard\Login::class, "authenticate");
