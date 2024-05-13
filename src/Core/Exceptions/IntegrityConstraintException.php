<?php

namespace Core\Exceptions;

use Exception;

class IntegrityConstraintException extends Exception {
    public function setMessage(string $message): void {
        $this->message = $message;
    }

    public function getKey(): string {
        $fkey = "";

        if ($this->getPrevious()) {
            preg_match_all('/(?<refs>[\w]*)(?=")/', $this->getPrevious(), $matches);

            $refs = array_filter($matches["refs"]);

            if ($refs) {
                foreach($refs as $ref) {
                    if (str_contains($ref, "_fkey")) {
                        $fkey = $ref;
                    }
                }
            }
        }

        return $fkey;
    }
}