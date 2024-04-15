<?php

use Core\Helpers;
use Core\Database;
use Models\Pessoas\AtualizarPessoaDTO;
use Models\Pessoas\CadastroPessoaDTO;
use Models\Pessoas\FiltrosBuscaDTO;
use Models\Pessoas\PessoasDAO;

$config = require(__DIR__."/../config.php");
$use_db = $config["use_db"];

$daoPessoas = new PessoasDAO(Database::getInstance($config[$use_db]));

runTests([
    # Buscar telefones
    [
        "fn" => function () use (&$daoPessoas) {
            $telefones = $daoPessoas->buscarTelefones(1);
        },
        "desc" => "Buscar telefones...",
        "run" => false,
    ],
    # Buscar pessoas com filtros
    [
        "fn" => function () use (&$daoPessoas) {
            $dto = new FiltrosBuscaDTO(tipo_pessoa: "F", tipo_vinculo: "CLI");
            $pessoas = $daoPessoas->buscarComFiltros($dto);
            Helpers::dump($pessoas);
        },
        "desc" => "Buscar pessoas com filtros...",
        "run" => false,
    ],
    # Buscar todas as pessoas
    [
        "fn" => function () use (&$daoPessoas) {
            $pessoas = $daoPessoas->buscarTodos();
        },
        "desc" => "Buscar todas as pessoas...",
        "run" => false,
    ],
    # Buscar pessoa
    [
        "fn" => function () use (&$daoPessoas) {
            $pessoa = $daoPessoas->buscar(1);
        },
        "desc" => "Buscar pessoa...",
        "run" => true,
    ],
    # Cadastrar pessoa
    [
        "fn" => function () use (&$daoPessoas) {
            $dto = new CadastroPessoaDTO(
                nome_razao: "Clebisnelson da Silva",
                tipo_pessoa: "F",
                tipo_vinculo: "CLI",
                documento: "00011122233",
                data_nasc_fund: "1991-05-01",
                cep: "8403000",
                numero: "331",
                complemento: "",
                telefones: ["(42) 99475-2945", "(41) 3221-3000"]
            );
            $pessoa = $daoPessoas->cadastrar($dto);
            Helpers::dump($pessoa);
        },
        "desc" => "Cadastrar pessoa...",
        "run" => false,
    ],
    # Atualizar pessoa
    [
        "fn" => function() use (&$daoPessoas) {
            $dto = new AtualizarPessoaDTO(
                id: 1, 
                nome_razao: "João da Silva",
                cep: "84000122",
                telefones: ["(42) 0000-0000", "(42) 3000-1111"]
            );
            $pessoa = $daoPessoas->atualizar($dto);
            Helpers::dump($pessoa);
        },
        "desc" => "Atualizar pessoa...",
        "run" => false,
    ],
    # Deletar pessoa
    [
        "fn" => function() use (&$daoPessoas) {
            Helpers::dump($daoPessoas->deletar(44));
        },
        "desc" => "Deletar pessoa...",
        "run" => false,
    ],
]);








