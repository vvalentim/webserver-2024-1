<?php

namespace Models\Usuarios;

class CadastroUsuarioDTO {
    public function __construct(
        public string $tipo_usuario,
        public string $nome,
        public string $email,
        public string $senha,
    ) {
        // TODO: formatar campos
    }
}