<?php

namespace Core;

use DateTime;

class Validator {
    public static function isEmpty(string $text): bool {
        return empty(trim($text));
    }

    public static function isOnLengthRange(string $text, int $min, int $max): bool {
        return strlen($text) >= $min && strlen($text) <= $max;
    }

    public static function hasNumber(string $text): bool {
        return preg_match("/\d/", $text);
    }

    public static function hasLetter(string $text): bool {
        return preg_match("/[a-z]/i", $text);
    }

    public static function hasLowercase(string $text): bool {
        return !ctype_upper($text);
    }

    public static function hasUppercase(string $text): bool {
        return !ctype_lower($text);
    }

    public static function hasSpecialCharacter(string $text): bool {
        return !ctype_alnum($text);
    }
    
    public static function isValidDate(string $date, string $format = "Y-m-d H:i:s"): bool {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    // Source: https://gist.github.com/rafael-neri/ab3e58803a08cb4def059fce4e3c0e40
    public static function isValidCPF(string $cpf): bool {
        // Extrai somente os números
        $cpf = preg_replace('/[^0-9]/is', '', $cpf );
         
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
    public static function isValidCNPJ(string $cnpj): bool {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        
        // Valida tamanho
        if (strlen($cnpj) != 14) {
            return false;
        }
    
        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj)) {
            return false;
        }
    
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }
    
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
    
        $resto = $soma % 11;
    
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    public static function isValidPhoneNumber(string $telefone): bool {
        return strlen(preg_replace("/\D/", "", $telefone)) >= 10;
    }

    public static function isValidCEP(string $cep): bool {
        return strlen(preg_replace("/\D/", "", $cep)) === 8;
    }

    public static function isValidEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}