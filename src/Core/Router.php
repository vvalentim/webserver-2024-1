<?php

namespace Core;

use Core\Helpers;

class Router {
    public $routes = [];

    protected function add($method, $uri, $controller) {
        $uri = trim($uri, "/");

        $this->routes[$method][$uri] = [
            "controller" => $controller,
            "middleware" => null,
        ];

        return $this;
    }

    public function get($uri, $controller) {
        return $this->add("GET", $uri, $controller);
    }
    
    public function post($uri, $controller) {
        return $this->add("POST", $uri, $controller);
    }
    
    public function delete($uri, $controller) {
        return $this->add("DELETE", $uri, $controller);
    }
    
    public function put($uri, $controller) {
        return $this->add("PUT", $uri, $controller);
    }
    
    public function patch($uri, $controller) {
        return $this->add("PATCH", $uri, $controller);
    }

    protected function abort($code) {
        http_response_code($code);
        
        return require(Helpers::getSourcePath()."/views/errors/{$code}.php");
    }

    public function route($method, $uri) {
        $uri = trim($uri, "/");
        $route = $this->routes[$method][$uri] ?? null;

        if ($route) {
            $class = $route["controller"];
            
            return new $class($method, "hello world!");
        }

        return $this->abort(404);
    }
}