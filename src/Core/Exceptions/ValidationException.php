<?php

namespace Core\Exceptions;

use Exception;
use Throwable;

class ValidationException extends Exception {
    public function __construct(
        private array $errors,
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function getErrors(): array {
        return $this->errors;
    }
}