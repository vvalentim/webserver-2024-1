<?php

use Core\Router;

$router = new Router();

# Site
$router->
    get("/", Controllers\Site\Inicio::class)->
    
    post("/leads/create", Controllers\Site\Lead::class, "create");

# Painel
$router->get("/painel", Controllers\Painel\Inicio::class);

# Pessoas
$router->
    get("/painel/pessoas", Controllers\Painel\Pessoas::class)->

    get("/painel/pessoas/cadastrar", Controllers\Painel\Pessoas::class, "cadastrar")->
    post("/painel/pessoas/cadastrar", Controllers\Painel\Pessoas::class, "cadastrar")->

    get("/painel/pessoas/editar/{idPessoa}", Controllers\Painel\Pessoas::class, "editar")->
    patch("/painel/pessoas/editar/{idPessoa}", Controllers\Painel\Pessoas::class, "editar")->
    
    get("/painel/pessoas/deletar/{idPessoa}", Controllers\Painel\Pessoas::class, "deletar");

# Leads
$router->
    get("/painel/leads", Controllers\Painel\Leads::class)->
    delete("/painel/leads/{idLead}", Controllers\Painel\Leads::class, "destroy");
    
# Imóveis
$router->
    get("/painel/imoveis", Controllers\Painel\Imoveis::class)->
    
    get("/painel/imoveis/cadastrar", Controllers\Painel\Imoveis::class, "cadastrar")->
    post("/painel/imoveis/cadastrar", Controllers\Painel\Imoveis::class, "create")->
    
    get("/painel/imoveis/editar/{idMovel}", Controllers\Painel\Imoveis::class, "editar")->
    post("/painel/imoveis/editar/{idImovel}", Controllers\Painel\Imoveis::class, "update")->

    delete("/painel/imoveis/{idImovel}", Controllers\Painel\Imoveis::class, "destroy");

# Login
$router->
    get("/painel/login", Controllers\Painel\Login::class)->
    post("/painel/login", Controllers\Painel\Login::class, "autenticar");
