<?php

namespace Core;

use Core\Helpers;

class Router {
    protected $routes = [];

    protected function add($method, $uri, $controller) {
        $uri = trim($uri, "/");
        $uri .= "/";
        $params = [];

        /**
         * This should extract all the parameters from the uri as long as it follow the
         * pattern of being enclosed with curly braces.
         * 
         * If there is subsequent matches (e.g.: posts/{id}{name}/), it will be ignored till a 
         * trailing slash is found, making only the last match a valid parameter.
         */
        if (preg_match_all("/{(?<params>[^{\/}]*)}(?=\/)/", $uri, $matches)) {
            $params = $matches['params'];
        }

        /**
         * Replace matches with a regex group and format the trailing slashes to store the 
         * pattern, which will be used to check on incoming requests when routing.
         */
        $pattern = preg_replace(["/{([^{\/}]*)}(?=\/)/", "/\//"], ["(\w*?)", "\/"], $uri);
        $pattern = "/^".$pattern."$/";
        
        $this->routes[$method][] = [
            "uri" => $uri,
            "controller" => $controller,
            "params" => $params,
            "pattern" => $pattern
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
        $uri .= "/";
        $routes = $this->routes[$method] ?? [];

        foreach($routes as $route) {
            if (preg_match($route["pattern"], $uri, $matches)) {
                array_shift($matches);

                $controller = $route["controller"];
                $params = array_combine($route["params"], $matches);

                return new $controller($method, $params);
            }
        }

        return $this->abort(404);
    }
}