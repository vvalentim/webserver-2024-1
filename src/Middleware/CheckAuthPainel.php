<?php

namespace Middleware;

use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

final class CheckAuthPainel implements IMiddleware {
    public function handle(Request $request): void {
        $autenticado = $_SESSION["autenticado"] ?? false;
        $isUrlLogin = $request->getUrl()->contains('/login');

        if ($isUrlLogin === true && $autenticado === true) {
            response()->redirect("/painel", 200);
        }
        
        if ($isUrlLogin !== true && $autenticado !== true) {
            response()->redirect("/painel/login", 401);
        }
    }
}