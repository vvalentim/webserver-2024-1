<?php

namespace Middleware;

use Core\Helpers;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

class VerificaAutenticacao implements IMiddleware {
    public function handle(Request $request): void {
        // TODO: verificar validade do usuário e token de sessão
        $autenticado = $_SESSION["autenticado"] ?? false;
        $isUrlLogin = url()->getAbsoluteUrl() === url("login")->getAbsoluteUrl();

        if ($isUrlLogin === true && $autenticado === true) {
            response()->redirect("/painel", 200);
        }
        
        if ($isUrlLogin !== true && $autenticado !== true) {
            response()->redirect("/painel/login", 401);
        }
    }
}