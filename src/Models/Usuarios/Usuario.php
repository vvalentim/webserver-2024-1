<?php

namespace Models\Usuarios;

use Core\Validator;

class Usuario {
    public const TAMANHO_MIN_SENHA = 6;
    public const TAMANHO_MAX_SENHA = 10;
    public const TAMANHO_MAX_NOME = 50;
    public const TAMANHO_MAX_EMAIL = 255;

    protected int $id;
    public string $tipo;
    public string $nome;
    public string $email;
    public string $hash_senha;

    public function id() {
        return $this->id;
    }
    
    // Início validações de cadastro
    public static function validarNomeUsuario(string $nome): bool {
        // O campo nome de usuário não pode estar vazio.
        if (Validator::isEmpty($nome)) {
            return false;
        }

        // O campo nome do usuário não pode ultrapassar o tamanho máximo.
        if (strlen($nome) > static::TAMANHO_MAX_NOME) {
            return false;
        }

        // O campo nome de usuário deve conter apenas caracteres alfanuméricos.
        if (ctype_alnum($nome)) {
            return false;
        }

        return true;
    }

    public static function validarEmail(string $email): bool {
        // Deve ser um endereço de e-mail válido.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > static::TAMANHO_MAX_EMAIL) {
            return false;
        }

        return true;
    }

    public static function validarSenha(string $senha): bool {
        // A senha deve conter o mínimo de 6 e máximo de 10 caracteres.
        if (!Validator::isOnLengthRange($senha, static::TAMANHO_MIN_SENHA, static::TAMANHO_MAX_SENHA)) {
            return false;
        }

        // A senha deve conter pelo menos um caractere alfabético.
        if (!Validator::hasLetter($senha)) {
            return false;
        }

        // A senha deve conter pelo menos um caractere numérico.
        if (!Validator::hasNumber($senha)) {
            return false;
        }

        // A senha deve conter pelo menos um caractere especial.
        if (!Validator::hasSpecialCharacter($senha)) {
            return false;
        }

        return true;
    }
    // Fim validações de cadastro

    public static function validarLogin(string $identificador, string $senha): bool {
        return 
            !Validator::isEmpty($identificador) && 
            !Validator::isEmpty($senha) &&
            strlen($identificador) <= static::TAMANHO_MAX_EMAIL &&
            Validator::isOnLengthRange($senha, static::TAMANHO_MIN_SENHA, static::TAMANHO_MAX_SENHA);
    }
}