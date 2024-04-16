<?php

namespace Models\Pessoas;

use Exception;

class FiltrosBuscaDTO {
    public function __construct(
        public ?string $nome_razao = null,
        public ?string $tipo_pessoa = null,
        public ?string $tipo_vinculo = null,
        public ?string $telefone = null,
    ) {
        $propriedades = array_filter(get_object_vars($this));

        if (empty($propriedades)) {
            throw new Exception("Nenhuma propriedade foi definida para o DTO.");
        }
        // TODO: formatar dados
    }
}