<?php

namespace Models\Pessoas;

class Pessoa {
    public int $id;
    public string $nome_razao;
    public string $tipo_pessoa;
    public string $tipo_vinculo;
    public string $documento;
    public string $data_nasc_fund;
    public string $cep;
    public string $numero;
    public string $complemento;
    public array $telefones;
}