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

    public static function camelToSnakeCase(string $string): string {
        return strtolower(
            preg_replace(
                "/(?<!^)([A-Z][a-z]|(?<=[a-z])[^a-z]|(?<=[A-Z])[0-9_])/",
                "_$1",
                $string
            )
        );
    }
}