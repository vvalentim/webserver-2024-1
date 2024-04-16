<?php

namespace Core;

use Core\Helpers;

class Router {
    protected $routes = [];

    protected function add(string $httpMethod, string $uri, string $controller, string $action): Router {
        $uri = trim($uri, "/");
        $uri .= "/";
        $params = [];

        // This should extract all the parameters from the uri as long as it follow the
        // pattern of being enclosed with curly braces.
        // Subsequent matches (e.g.: posts/{id}{name}/) will be ignored till a 
        // trailing slash is found, making only the last match a valid parameter.
        if (preg_match_all("/{(?<params>[^{\/}]*)}(?=\/)/", $uri, $matches)) {
            $params = $matches['params'];
        }

        
        // Replace matches with a regex group and format the trailing slashes to store the 
        // pattern, which will be used to check on incoming requests when routing.
        $pattern = preg_replace(["/{([^{\/}]*)}(?=\/)/", "/\//"], ["(\w*?)", "\/"], $uri);
        $pattern = "/^".$pattern."$/";
        
        $this->routes[$httpMethod][] = [
            "uri" => $uri,
            "controller" => $controller,
            "action" => $action,
            "params" => $params,
            "pattern" => $pattern
        ];

        return $this;
    }

    public function get(string $uri, string $controller, string $action = "view"): Router {
        return $this->add("GET", $uri, $controller, $action);
    }
    
    public function post(string $uri, string $controller, string $action): Router {
        return $this->add("POST", $uri, $controller, $action);
    }
    
    public function delete(string $uri, string $controller, string $action): Router {
        return $this->add("DELETE", $uri, $controller, $action);
    }
    
    public function put(string $uri, string $controller, string $action): Router {
        return $this->add("PUT", $uri, $controller, $action);
    }
    
    public function patch(string $uri, string $controller, string $action): Router {
        return $this->add("PATCH", $uri, $controller, $action);
    }

    public function route(string $httpMethod, string $uri): mixed {
        $uri = trim($uri, "/");
        $uri .= "/";
        $routes = $this->routes[$httpMethod] ?? [];

        foreach($routes as $route) {
            if (preg_match($route["pattern"], $uri, $matches)) {
                array_shift($matches);

                $params = array_combine($route["params"], $matches);
                $controllerClass = $route["controller"];
                $controllerMethod = $route["action"];

                $controller = new $controllerClass($httpMethod, $params);

                return call_user_func(array($controller, $controllerMethod));
            }
        }

        return Helpers::abort();
    }
}