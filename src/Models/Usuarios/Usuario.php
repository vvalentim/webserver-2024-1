<?php

namespace Models\Usuarios;

use Core\Validator;

class Usuario {
    protected const TAMANHO_MIN_SENHA = 6;
    protected const TAMANHO_MAX_SENHA = 10;

    public int $id;
    public string $tipo;
    public string $nome;
    public string $email;
    public string $hash_senha;

    // Início validações de cadastro
    public static function validarNomeUsuario(string $nome): array {
        $erros = [];

        if (Validator::isEmpty($nome)) {
            $erros[] = "O campo nome de usuário não pode estar vazio.";
        }

        if (ctype_alnum($nome)) {
            $erros[] = "O campo nome de usuário deve conter apenas caracteres alfanuméricos.";
        }

        return $erros;
    }

    public static function validarEmail(string $email): array {
        $erros = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "'{$email}' não é um endereço de e-mail válido.";
        }

        return $erros;
    }

    public static function validarSenha(string $senha): array {
        $erros = [];

        if (Validator::isEmpty($senha)) {
            $erros[] = "O campo senha não pode estar vazio.";
        }

        if (!Validator::isOnLengthRange($senha, static::TAMANHO_MIN_SENHA, static::TAMANHO_MAX_SENHA)) {
            $erros[] = "A senha deve conter o mínimo de ".static::TAMANHO_MIN_SENHA." e máximo de ".static::TAMANHO_MAX_SENHA." caracteres.";
        }

        if (!Validator::hasLetter($senha)) {
            $erros[] = "A senha deve conter pelo menos um caractere alfabético.";
        }

        if (!Validator::hasNumber($senha)) {
            $erros[] = "A senha deve conter pelo menos um caractere numérico.";
        }

        if (!Validator::hasSpecialCharacter($senha)) {
            $erros[] = "A senha deve conter pelo menos um caractere especial.";
        }

        return $erros;
    }
    // Fim validações de cadastro

    public static function validarLogin(string $identificador, string $senha): bool {
        return 
            !Validator::isEmpty($identificador) && 
            !Validator::isEmpty($senha) &&
            Validator::isOnLengthRange($senha, static::TAMANHO_MIN_SENHA, static::TAMANHO_MAX_SENHA);
    }
}