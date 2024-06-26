<?php

use Handlers\ApiExceptionHandler;
use Handlers\FrontExceptionHandler;
use Middleware\CheckAuthApi;
use Middleware\CheckAuthPainel;
use Pecee\SimpleRouter\SimpleRouter as Router;

# Rotas do site
Router::group(["namespace" => "\\Controllers\\Site"], function() {
    Router::get("/", "Inicio@index");
});

# Rotas do painel
Router::group([
    "namespace" => "\\Controllers\\Painel",
    "prefix" => "/painel",
    "exceptionHandler" => FrontExceptionHandler::class,
], function() {
    
    Router::group(["middleware" => CheckAuthPainel::class], function() {
        Router::form("/login", "Login@index")->name("login");
        Router::form("/logout", "Login@sair")->name("logout");
        Router::get("/", "Dashboard@index");
        
        Router::get("/pessoas", "Pessoas@index");
        Router::get("/pessoas/cadastrar", "Pessoas@formCadastrar");
        Router::get("/pessoas/{id}/editar", "Pessoas@formEditar");

        Router::get("/usuarios", "Usuarios@index");

        Router::get("/imoveis", "Imoveis@index");
        Router::get("/imoveis/cadastrar", "Imoveis@formCadastrar");
        Router::get("/imoveis/{id}/editar", "Imoveis@formEditar");
        
        Router::get("/leads", "Leads@index");
    });

})->where(["id" => "[0-9]+"]);

# Rotas da API
Router::group([
    "namespace" => "\\Controllers\\Api",
    "prefix" => "/api",
    "exceptionHandler" => ApiExceptionHandler::class
], function() {
    
    Router::group(["middleware" => CheckAuthApi::class], function() {
        Router::group(["prefix" => "/pessoas"], function() {
            Router::get("/{id?}", "ApiPessoas@index");
            Router::post("/", "ApiPessoas@cadastrar");
            Router::put("/{id}", "ApiPessoas@editar");
            Router::delete("/{id}", "ApiPessoas@deletar");
        });
    });

})->where(["id" => "[0-9]+"]);;