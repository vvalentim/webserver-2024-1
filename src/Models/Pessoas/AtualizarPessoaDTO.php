<?php

namespace Models\Pessoas;

use Exception;

class AtualizarPessoaDTO {
    public function __construct(
        protected int $id,
        public ?string $nome_razao = null,
        public ?string $tipo_pessoa = null,
        public ?string $tipo_vinculo = null,
        public ?string $documento = null,
        public ?string $data_nasc_fund = null,
        public ?string $cep = null,
        public ?string $numero = null,
        public ?string $complemento = null,
        protected ?array $telefones = [],
    ) {
        $propriedades = array_filter(get_object_vars($this));
        unset($propriedades["id"]);

        if (empty($propriedades)) {
            throw new Exception("Nenhuma propriedade foi definida para o DTO.");
        }
    }

    public function id() {
        return $this->id;
    }

    public function telefones() {
        return $this->telefones;
    }
}