<?php

namespace Models\Usuarios;

use Exception;

class FiltrosBuscaDTO {
    public function __construct(
        public ?string $nome = null,
        public ?string $email = null,
        public ?string $tipo = null,
    ) {
        $propriedades = array_filter(get_object_vars($this));

        if (empty($propriedades)) {
            throw new Exception("Nenhuma propriedade foi definida para o DTO.");
        }
        // TODO: formatar dados
    }
}