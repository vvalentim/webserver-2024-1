<?php

namespace Handlers;

use Core\Helpers;
use Pecee\Http\Request;
use Exception;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;

final class FrontExceptionHandler implements IExceptionHandler {
    public function handleError(Request $request, Exception $error): void {
        Helpers::dump($error, true);

        if ($error instanceof NotFoundHttpException) {
            $request->setRewriteCallback("Controllers\\Error@notFound");
            
            return;
        }

        $request->setRewriteCallback("Controllers\\Error@internalError");
    }
}