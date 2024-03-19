<?php

namespace Core;

class Helpers {
    public static function dd($var) {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die();
    }

    public static function getBasePath() {
        return __DIR__ . "/../..";
    }

    public static function getSourcePath() {
        return __DIR__ . "/..";
    }
}