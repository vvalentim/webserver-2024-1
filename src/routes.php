<?php

use Pecee\SimpleRouter\SimpleRouter as Router;

# Rotas do site
Router::group(["namespace" => "\\Controllers\\Site"], function() {
    Router::get("/", "Inicio@view");
    
    Router::post("/leads/create", "Lead@create");
});

# Rotas do painel
Router::group([
    "namespace" => "\\Controllers\\Painel", 
    "prefix" => "/painel"
], function() {
    # Login
    Router::form("/login", "Login@view");
    
    # Rotas com autenticação obrigatória
    Router::group([], function() {
        Router::get("/", "Inicio@view");

        # Pessoas
        Router::group(["prefix" => "/pessoas"], function() {
            Router::get("/", "Pessoas@view");

            Router::get("/cadastrar", "Pessoas@formCadastrar");
            Router::post("/cadastrar", "Pessoas@cadastrar");

            Router::get("/editar/{idPessoa}", "Pessoas@formEditar");
            Router::patch("/editar/{idPessoa}", "Pessoas@editar");

            Router::get("/deletar/{idPessoa}", "Pessoas@deletar");
        })->where([ "idPessoa" => "[0-9]+" ]);

        # Imóveis
        Router::group(["prefix" => "/imoveis"], function() {
            Router::get("/", "Imoveis@view");

            Router::get("/cadastrar", "Imoveis@formCadastrar");
            Router::post("/cadastrar", "Imoveis@create");

            Router::get("/editar/{idImovel}", "Imoveis@formEditar");
            Router::post("/editar/{idImovel}", "Imoveis@update");

            Router::delete("/deletar/{idImovel}", "Imoveis@destroy");
        })->where([ "idImovel" => "[0-9]+" ]);

        # Leads
        Router::group(["prefix" => "/leads"], function() {
            Router::get("/", "Leads@view");

            Router::delete("/deletar/{idLead}", "Leads@destroy");
        });

    });
});