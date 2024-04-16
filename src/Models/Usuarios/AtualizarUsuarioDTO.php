<?php

namespace Models\Usuarios;

use Exception;

class AtualizarUsuarioDTO {
    public function __construct(
        protected int $id,
        public ?string $tipo_usuario = null,
        public ?string $nome = null,
        public ?string $email = null,
        public ?string $senha = null,
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
}