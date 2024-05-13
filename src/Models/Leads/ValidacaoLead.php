<?php

use Core\InputValidation;
use Core\Validator;

final class ValidacaoLead extends InputValidation {
    public const TAMANHO_MAX_NOME = 100;
    public const TAMANHO_MAX_EMAIL = 255;
    public const TAMANHO_MAX_ASSUNTO = 100;
    public const TAMANHO_MAX_MENSAGEM = 500;

    public function nome(string $nome): ValidacaoLead {
        if (Validator::isEmpty($nome)) {
            $this->addError("nome", "O nome não pode estar vazio.");
        }

        if (strlen($nome) > static::TAMANHO_MAX_NOME) {
            $this->addError("nome", sprintf("O nome deve conter no máximo %d caracteres.", static::TAMANHO_MAX_NOME));
        }

        return $this;
    }
    
    public function email(string $email): ValidacaoLead {
        if (!Validator::isValidEmail($email) || strlen($email) > static::TAMANHO_MAX_EMAIL) {
            $this->addError("email", "O endereço de email é inválido.");
        }

        return $this;
    }

    public function assunto(string $assunto): ValidacaoLead {
        if (Validator::isEmpty($assunto)) {
            $this->addError("assunto", "O assunto não pode estar vazio.");
        }

        if (strlen($assunto) > static::TAMANHO_MAX_ASSUNTO) {
            $this->addError("nome", sprintf("O assunto deve conter no máximo %d caracteres.", static::TAMANHO_MAX_ASSUNTO));
        }

        return $this;
    }
    
    public function mensagem(string $mensagem): ValidacaoLead {
        if (strlen($mensagem) > static::TAMANHO_MAX_MENSAGEM) {
            $this->addError("nome", sprintf("A mensagem deve conter no máximo %d caracteres.", static::TAMANHO_MAX_MENSAGEM));
        }

        return $this;
    }
}