<?php

namespace Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class VerificaAutenticacao implements IMiddleware {
    public function handle(Request $request): void {
        // TODO: verificar validade do usuário e token de sessão
        if (empty($_SESSION["autenticado"]) || $_SESSION["autenticado"] !== true) {
            response()->redirect("/painel/login", 401);
        }
    }
}