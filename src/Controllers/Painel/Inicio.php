<?php

namespace Controllers\Painel;

use Core\Controller;
use Core\Helpers;

class Inicio extends Controller {
    public function __construct($method, $params) {
        parent::__construct(
            Helpers::getPath("views")."/painel/inicio.view.php",
            null,
            $method,
            $params
        );
    }

    public function view() {
        $this->setAttribute("navActiveUri", "/painel");
        $this->render();
    }
}