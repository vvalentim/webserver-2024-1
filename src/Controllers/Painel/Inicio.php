<?php

namespace Controllers\Painel;

use Core\Controller;
use Core\Helpers;

class Inicio extends Controller {
    public function __construct(
        protected string $httpMethod, 
        protected array $httpParams,
    ) {
        parent::__construct($httpMethod, $httpParams);

        // TODO: middleware de autenticação/autorização
        if (!Login::autenticado()) {
            parent::redirect("/painel/login", 401);
        }
    }

    public function view() {
        $this->setAttribute("page_layout_css", "painel");
        $this->setView(Helpers::getPath("views")."/painel/inicio.view.php");
        $this->setAttribute("navActiveUri", "/painel");
        $this->render();
    }
}