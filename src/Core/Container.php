<?php

namespace Core;

use Exception;

class Container {
    protected $bindings = [];

    public function bind(string $key, callable $resolver): void {
        $this->bindings[$key] = $resolver;
    }

    public function resolve(string $key): mixed {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching key '{$key}' on this container.");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}