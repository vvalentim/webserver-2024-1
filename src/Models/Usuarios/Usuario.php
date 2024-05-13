<?php

namespace Models\Usuarios;

use Core\ActiveRecord;

/**
 * @method string email()
 * @method string username()
 * @method string hashSenha()
 * 
 * @method Usuario setEmail(string $email)
 * @method Usuario setUsername(string $username)
 */
final class Usuario extends ActiveRecord {
    protected const TABLE = "usuarios";

    protected string $email;
    protected string $username;
    protected string $hash_senha;

    public function setHashSenha(string $senha) {
        $this->hash_senha = password_hash($senha, PASSWORD_BCRYPT);

        return $this;
    }

    public function compararSenha(string $senha): bool {
        return isset($this->hash_senha) && password_verify($senha, $this->hash_senha);
    }
}