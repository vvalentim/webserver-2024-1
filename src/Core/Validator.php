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
}