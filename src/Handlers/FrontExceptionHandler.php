<?php

namespace Handlers;

use Pecee\Http\Request;
use Exception;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;
use Pecee\SimpleRouter\Handlers\IExceptionHandler;

final class FrontExceptionHandler implements IExceptionHandler {
    public function handleError(Request $request, Exception $error): void {
        if ($error instanceof NotFoundHttpException) {
            $request->setRewriteCallback("Controllers\\Error@notFound");
        }

        $request->setRewriteCallback("Controllers\\Error@internalError");
    }
}