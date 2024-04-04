<?php

namespace Core;

use Exception;

class Helpers {
    private static $paths = [
        "base" => __DIR__."/../..",
        "source" => __DIR__."/..",
        "views" => __DIR__."/../views",
        "controllers" => __DIR__."/../Controllers",
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
        if (!array_key_exists($key, static::$paths)) {
            throw new Exception("No matching key '{$key}' for paths.");
        }

        return static::$paths[$key];
    }
}