<?php

$_mockData = [
    "view" => [
        [
            "id" => "1",
            "nome" => "João da Silva", 
            "telefones" => [
                "(42) 99999-9999",
                "(42) 99999-0000",
            ],
            "tipoPessoa" => "fisica",
            "tipoVinculo" => "cliente",
        ],
        [ 
            "id" => "2",
            "nome" => "Maria", 
            "telefones" => [
                "(42) 99999-9999"
            ],
            "tipoPessoa" => "fisica",
            "tipoVinculo" => "cliente",
        ],
        [
            "id" => "3",
            "nome" => "Felipe", 
            "telefones" => [
                "(42) 99999-1111",
                "(42) 99999-1111",
                "(42) 99999-1111"
            ],
            "tipoPessoa" => "juridica",
            "tipoVinculo" => "colaborador",
        ],
    ],
    "editar" => [
        "1" => [
            "tipoPessoa" => "fisica",
            "tipoVinculo" => "cliente",
            "nome" => "João da Silva",
            "documento" => "000.000.000-00",
            "nascimento" => "01/01/1999",
            "cep" => "84000-000",
            "logradouro" => "Rua Fulano de Tal",
            "numero" => "100",
            "bairro" => "Jardim Alguma Coisa",
            "cidade" => "Ponta Grossa",
            "uf" => "PR",
            "telefones" => [
                "(42) 99999-9999",
                "(42) 99999-0000",
            ],
        ],
    ],
];