<?php

use Core\Router;

$router = new Router();

// Routes definition
$router->get("/painel", Controllers\Painel\Inicio::class);

$router->get("/painel/pessoas", Controllers\Painel\Pessoas::class);
$router->get("/painel/pessoas/cadastrar", Controllers\Painel\Pessoas::class, "cadastrar");
$router->get("/painel/pessoas/editar/{idPessoa}", Controllers\Painel\Pessoas::class, "editar");

$router->get("/painel/login", Controllers\Painel\Login::class);
$router->post("/painel/login", Controllers\Painel\Login::class, "autenticar");
