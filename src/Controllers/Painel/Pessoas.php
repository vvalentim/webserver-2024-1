<?php

namespace Controllers\Painel;

use Core\Controller;
use Core\Helpers;

class Pessoas extends Controller {
    public function __construct($method, $params) {
        parent::__construct(
            Helpers::getPath("views")."/painel/pessoas/view.php",
            null,
            $method,
            $params
        );
    }

    public function view() {
        $this->setAttribute("navActiveUri", "/painel/pessoas");
        $this->render();
    }
}