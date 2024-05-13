<?php

namespace Middleware;

use Core\Exceptions\UnauthorizedException;
use Pecee\Http\Middleware\IMiddleware;
use Pecee\Http\Request;

final class CheckAuthApi implements IMiddleware {
    public function handle(Request $request): void {
        $autenticado = $_SESSION["autenticado"] ?? false;

        if (!$autenticado) {
            throw new UnauthorizedException();
        }
    }
}