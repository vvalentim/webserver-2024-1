<?php

namespace Models\Pessoas;

use Core\InputValidation;
use Core\Validator;

class ValidacaoPessoa extends InputValidation {
    public const TAMANHO_MAX_NOME = 100;
    public const TAMANHO_MAX_NUMERO = 30;
    public const TAMANHO_MAX_COMPLEMENTO = 50;
    public const QNTD_MAX_TELEFONES = 3;

    public function nome(string $nome): ValidacaoPessoa {
        if (Validator::isEmpty($nome)) {
            $this->addError("nome", "O nome não pode estar vazio.");
        }

        if (strlen($nome) > static::TAMANHO_MAX_NOME) {
            $this->addError("nome", sprintf("O nome deve conter no máximo %d caracteres.", static::TAMANHO_MAX_NOME));
        }

        return $this;
    }

    public function documentoTipo(string $tipo): ValidacaoPessoa {
        if ($tipo !== "J" && $tipo !== "F") {
            $this->addError("documentoTipo", "O tipo de documento selecionado é inválido.");
        }

        return $this;
    }

    public function cpf(string $cpf): ValidacaoPessoa {
        if (!Validator::isValidCPF($cpf)) {
            $this->addError("documento", "O CPF informado é inválido.");
        }

        return $this;
    }

    public function cnpj(string $cnpj): ValidacaoPessoa {
        if (!Validator::isValidCNPJ($cnpj)) {
            $this->addError("documento", "O CNPJ informado é inválido.");
        }

        return $this;
    }
    
    public function nascimento(string $data): ValidacaoPessoa {
        if (!Validator::isValidDate($data, "d/m/Y")) {
            $this->addError("nascimento", "A data de nascimento informada é inválida.");
        }
        
        return $this;
    }

    public function cep(string $cep): ValidacaoPessoa {
        if (!Validator::isValidCEP($cep)) {
            $this->addError("cep", "O CEP informado é inválido");
        }

        return $this;
    }

    public function numero(string $numero): ValidacaoPessoa {
        if (Validator::isEmpty($numero)) {
            $this->addError("numero", "O número do endereço não pode estar vazio.");
        }

        if (strlen($numero) > static::TAMANHO_MAX_NUMERO) {
            $this->addError("numero", sprintf(
                "O numéro do endereço deve conter no máximo %d caracteres.", 
                static::TAMANHO_MAX_NUMERO
            ));
        }

        return $this;
    }

    public function complemento(string $complemento): ValidacaoPessoa {
        if (strlen($complemento) > static::TAMANHO_MAX_COMPLEMENTO) {
            $this->addError("complemento", sprintf(
                "O complemento do endereço deve conter no máximo %d caracteres.", 
                static::TAMANHO_MAX_COMPLEMENTO
            ));
        }

        return $this;
    }

    public function telefones(array $telefones): ValidacaoPessoa {
        if (empty($telefones)) {
            $this->addError("telefones", "O cadastro deve conter pelo menos um número de telefone.");
        } else if (count($telefones) > 3) {
            $this->addError("telefones", sprintf(
                "O cadastro não pode ter mais do que %d telefones", 
                static::QNTD_MAX_TELEFONES
            ));
        }

        foreach($telefones as $telefone) {
            if (!Validator::isValidPhoneNumber($telefone)) {
                $this->addError("telefones", "O número de telefone '{$telefone}' é inválido.");
            }
        }

        return $this;
    }
}