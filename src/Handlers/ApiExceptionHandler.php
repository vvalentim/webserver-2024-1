<?php

namespace Handlers;

use Core\Exceptions\IntegrityConstraintException;
use Core\Exceptions\UnauthorizedException;
use Core\Exceptions\ValidationException;
use Exception;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;

final class ApiExceptionHandler implements IExceptionHandler {
    public function handleError(Request $request, Exception $exception): void {
        if ($exception instanceof UnauthorizedException) {
            response()->httpCode(401)->json([
                "message" => "Acesso não autorizado.",
            ]);
        }

        if ($exception instanceof NotFoundHttpException) {
            response()->httpCode(404)->json([
                "message" => "O recurso não foi encontrado.",
            ]);
        }
        
        if ($exception instanceof ValidationException) {
            response()->httpCode(400)->json([
                "errors" => $exception->getErrors(),
            ]);
        }

        if ($exception instanceof IntegrityConstraintException) {
            response()->httpCode(400)->json([
                "message" => $exception->getMessage(),
            ]);
        }

        response()->httpCode(500)->json([
            "message" => "Falha interna no servidor.",
        ]);
    }
}