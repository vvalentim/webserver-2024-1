<?php

namespace Core\Enums;

// Reference: https://www.postgresql.org/docs/current/errcodes-appendix.html
enum IntegrityExceptionCode: string {
    case ForeignKeyViolation = "23503";
    case UniqueViolation = "23505";
}