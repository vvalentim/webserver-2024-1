<?php

namespace Models\Pessoas;

class CadastroPessoaDTO {
    public function __construct(
        public string $nome_razao,
        public string $tipo_pessoa,
        public string $tipo_vinculo,
        public string $documento,
        public string $data_nasc_fund,
        public string $cep,
        public string $numero,
        public string $complemento,
        protected array $telefones
    ) {
        // TODO: formatar campos
    }

    public function telefones() {
        return $this->telefones;
    }
}