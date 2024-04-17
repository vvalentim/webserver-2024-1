<?php

namespace Models\Pessoas;

use Core\Validator;
use DateTime;

class Pessoa {
    public const TAMANHO_MAX_NOME = 60;
    public const TAMANHO_MAX_NUMERO = 30;
    public const TAMANHO_MAX_COMPLEMENTO = 50;

    protected int $id;
    public string $nome_razao;
    public string $tipo_pessoa;
    public string $tipo_vinculo;
    public string $documento;
    public string $data_nasc_fund;
    public string $cep;
    public string $numero;
    public string $complemento;
    public array $telefones;

    public function __construct() {
        // Formata os campos necessários para apresentação
        $this->data_nasc_fund = DateTime::createFromFormat("Y-m-d", $this->data_nasc_fund)->format("d/m/Y");
    }

    public function id(): int {
        return $this->id;
    }

    public static function validarNome(string $nome): bool {
        return !Validator::isEmpty($nome);
    }

    public static function validarTipoPessoa(string $tipo): bool {
        return $tipo === "J" || $tipo == "F";
    }

    public static function validarTipoVinculo(string $tipo): bool {
        return $tipo === "CLI" || $tipo === "COL";
    }

    // Source: https://gist.github.com/rafael-neri/ab3e58803a08cb4def059fce4e3c0e40
    public static function validarCPF(string $cpf): bool {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    // Source: https://gist.github.com/guisehn/3276302
    public static function validarCNPJ(string $cnpj): bool {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;	

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    public static function validarData(string $data): bool {
        return Validator::isValidDate($data, "d/m/Y");
    }

    public static function validarCEP(string $cep): bool {
        return
            !Validator::isEmpty($cep) &&
            strlen($cep) === 8;
    }

    public static function validarNumero(string $numero): bool {
        return 
            !Validator::isEmpty($numero) &&
            strlen($numero) <= static::TAMANHO_MAX_NUMERO;
    }

    public static function validarComplemento(string $complemento): bool {
        return strlen($complemento) <= static::TAMANHO_MAX_COMPLEMENTO;
    }
}