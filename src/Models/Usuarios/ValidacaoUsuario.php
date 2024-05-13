<?php

namespace Models\Usuarios;

use Core\InputValidation;
use Core\Validator;

final class ValidacaoUsuario extends InputValidation {
    public const TAMANHO_MIN_SENHA = 6;
    public const TAMANHO_MAX_SENHA = 10;
    public const TAMANHO_MIN_USERNAME = 5;
    public const TAMANHO_MAX_USERNAME = 50;
    public const TAMANHO_MAX_EMAIL = 255;

    public function username(string $username): ValidacaoUsuario {
        if (!Validator::isOnLengthRange($username, static::TAMANHO_MIN_USERNAME, static::TAMANHO_MAX_USERNAME)) {
            $this->addError("username", sprintf(
                "O nome de usuário deve conter o mínimo de %d e máximo de %d caracteres.",
                static::TAMANHO_MIN_USERNAME,
                static::TAMANHO_MAX_USERNAME,
            ));
        }

        if (!ctype_alnum($username)) {
            $this->addError("username", "O nome de usuário deve conter apenas caracteres alfanuméricos.");
        }

        return $this;
    }

    public function email(string $email): ValidacaoUsuario {
        if (!Validator::isValidEmail($email) || strlen($email) > static::TAMANHO_MAX_EMAIL) {
            $this->addError("email", "O endereço de email é inválido.");
        }

        return $this;
    }

    public function senha(string $senha): ValidacaoUsuario {
        if (!Validator::isOnLengthRange($senha, static::TAMANHO_MIN_SENHA, static::TAMANHO_MAX_SENHA)) {
            $this->addError("senha", sprintf(
                "A senha deve conter o mínimo de %d e máximo de %d caracteres.",
                static::TAMANHO_MIN_SENHA,
                static::TAMANHO_MAX_SENHA,
            ));
        }

        if (!Validator::hasLetter($senha)) {
            $this->addError("senha", "A senha deve conter pelo menos um caractere alfabético.");
        }

        if (!Validator::hasNumber($senha)) {
            $this->addError("senha", "A senha deve conter pelo menos um caractere numérico.");
        }

        if (!Validator::hasSpecialCharacter($senha)) {
            $this->addError("senha", "A senha deve conter pelo menos um caractere especial.");
        }

        return $this;
    }
}