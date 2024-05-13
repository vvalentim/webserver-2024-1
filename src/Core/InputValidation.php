<?php

namespace Core;

use BadMethodCallException;

abstract class InputValidation {
    protected $errors = [];

    protected function __construct() {}

    public function addError(string $field, string $message): void {
        $this->errors[] = [
            "field" => $field,
            "message" => $message,
        ];
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public static function validate(null|array $fields = null): static {
        $validation = new static();

        if (!empty($fields)) {
            foreach($fields as $fieldMethod => $fieldValue) {
                if (method_exists(static::class, $fieldMethod)) {
                    call_user_func([$validation, $fieldMethod], $fieldValue);
                }
            }
        }

        return $validation;
    }
}