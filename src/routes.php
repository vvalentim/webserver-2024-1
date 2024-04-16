<?php

use Core\Router;

$router = new Router();

// Routes definition

//site
$router->get("/", Controllers\Site\Inicio::class);

//panel
$router->get("/painel", Controllers\Painel\Inicio::class);

$router->get("/painel/pessoas", Controllers\Painel\Pessoas::class);
$router->get("/painel/pessoas/cadastrar", Controllers\Painel\Pessoas::class, "cadastrar");
$router->get("/painel/pessoas/editar/{idPessoa}", Controllers\Painel\Pessoas::class, "editar");

$router->post("/leads/create", Controllers\Site\Lead::class, "create");
$router->get("/painel/leads", Controllers\Painel\Leads::class);
$router->delete("/painel/leads/{idLead}", Controllers\Painel\Leads::class, "destroy");

$router->get("/painel/imoveis", Controllers\Painel\Imoveis::class);
$router->get("/painel/imoveis/cadastrar", Controllers\Painel\Imoveis::class, "cadastrar");
$router->post("/painel/imoveis/cadastrar", Controllers\Painel\Imoveis::class, "create");
$router->get("/painel/imoveis/editar/{idMovel}", Controllers\Painel\Imoveis::class, "editar");
$router->delete("/painel/imoveis/{idImovel}", Controllers\Painel\Imoveis::class, "destroy");

$router->get("/painel/login", Controllers\Painel\Login::class);
$router->post("/painel/login", Controllers\Painel\Login::class, "authenticate");
