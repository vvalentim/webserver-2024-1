<?php

namespace Core\Traits;

use BadMethodCallException;
use Core\Helpers;
use InvalidArgumentException;

/**
 * CallableGetSet will enable the use of methods for get and set operations.
 * 
 * CallableGetSet will convert 'camelCase' method calls to the corresponding class 
 * property. To set the value of a property the method call should be prefixed by 
 * 'set'. Properties prefixed with '_' will not be accessible when using this trait.
 * 
 */
trait CallableGetSet {
    public function __call(string $name, array $args) {
        $property = Helpers::camelToSnake($name);

        if (str_starts_with($property, "_")) {
            throw new InvalidArgumentException("Property or method '{$property}' is not available.");
        }

        if (str_starts_with($property, "set")) {
            $property = str_replace("set_", "", $property);

            if (!property_exists($this, $property)) {
                throw new BadMethodCallException("Property '{$property}' doesn't not exist.");
            }

            if (empty($args)) {
                throw new BadMethodCallException("Empty arguments array on call to setter method '{$name}'.");
            }

            $this->$property = $args[0];

            return $this;
        }

        if (property_exists($this, $property)) {
            return $this->$property ?? null;
        }

        throw new BadMethodCallException("Method or property '{$property}' doesn't not exist.");
    }
}