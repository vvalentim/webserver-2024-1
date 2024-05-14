<?php

namespace Controllers;

use Core\Controller;
use Core\Helpers;

final class Error extends Controller {
    public function __construct() {
        parent::__construct([
            "page_layout_css" => "painel",
        ]);
    }

    public function notFound() {
        $this->
            setAttribute("code", "404")->
            setAttribute("title", "Página não encontrada")->
            setAttribute("description", "A página que você está procurando não foi encontrada.")->
            render(view: "base", path: Helpers::getPath("errors"));
    }

    public function internalError() {
        $this->
            setAttribute("code", "500")->
            setAttribute("title", "Erro no servidor")->
            setAttribute("description", "Não foi possível processar sua requisição, um erro interno ocorreu no servidor.")->
            render(view: "base", path: Helpers::getPath("errors"));
    }
}