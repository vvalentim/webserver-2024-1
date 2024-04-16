<?php

use Core\Router;

$router = new Router();

$router->get("/painel", Controllers\Painel\Inicio::class);

# Pessoas
$router->
    get("/painel/pessoas", Controllers\Painel\Pessoas::class)->

    get("/painel/pessoas/cadastrar", Controllers\Painel\Pessoas::class, "cadastrar")->
    post("/painel/pessoas/cadastrar", Controllers\Painel\Pessoas::class, "cadastrar")->

    get("/painel/pessoas/editar/{idPessoa}", Controllers\Painel\Pessoas::class, "editar")->
    patch("/painel/pessoas/editar/{idPessoa}", Controllers\Painel\Pessoas::class, "editar")->
    
    get("/painel/pessoas/deletar/{idPessoa}", Controllers\Painel\Pessoas::class, "deletar");

# Login
$router->
    get("/painel/login", Controllers\Painel\Login::class)->
    post("/painel/login", Controllers\Painel\Login::class, "autenticar");
