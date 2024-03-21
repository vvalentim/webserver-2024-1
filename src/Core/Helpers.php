<?php

namespace Core;

class Helpers {
    public static function dump($var, $die = false) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        
        if ($die) {
            exit();
        }
    }

    public static function jsondump($var) {
        header("Content-Type: application/json");
        echo json_encode($var);
        
        exit();
    }

    public static function getBasePath() {
        return __DIR__ . "/../..";
    }

    public static function getSourcePath() {
        return __DIR__ . "/..";
    }
}