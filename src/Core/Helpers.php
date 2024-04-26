<?php

namespace Core;

use Exception;

class Helpers {
    public const PATHS = [
        "base" => "/../..",
        "source" => "/..",
        "views" => "/../views",
        "controllers" => "/../Controllers",
    ];

    public static function dump(mixed $var, bool $die = false): void {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        
        if ($die) {
            exit();
        }
    }

    public static function jsonDump(mixed $var): void {
        header("Content-Type: application/json");
        echo json_encode($var);
        
        exit();
    }
    
    public static function getPath(string $key): string {
        if (!array_key_exists($key, static::PATHS)) {
            throw new Exception("No matching key '{$key}' for paths.");
        }

        return __DIR__ . static::PATHS[$key];
    }
    
    public static function abort(int $code, string $title, string $description, string $page_layout_css): void {
        http_response_code($code);
        
        require(static::getPath("views")."/errors/base.php");

        exit();
    }

    // Code from: https://stackoverflow.com/questions/1993721/how-to-convert-pascalcase-to-snake-case, authored by @xiaojing.
    public static function camelToSnake($camel): string {
        $snake = preg_replace('/[A-Z]/', '_$0', $camel);
        $snake = strtolower($snake);
        $snake = ltrim($snake, '_');
        
        return $snake;
    }

    public static function onlyNumbersAsString(string $string): string {
        return preg_replace("/\D/", "", $string);
    }
}