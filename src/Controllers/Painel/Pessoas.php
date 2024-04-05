<?php

namespace Controllers\Painel;

use Core\Controller;
use Core\Helpers;

class Pessoas extends Controller {
    public function cadastrar() {
        $this->setView(Helpers::getPath("views")."/painel/pessoas/cadastrar.php");
        $this->setAttribute("navActiveUri", "/painel/pessoas");
        $this->render();
    }

    public function view() {
        $this->setView(Helpers::getPath("views")."/painel/pessoas/view.php");
        $this->setAttribute("navActiveUri", "/painel/pessoas");
        $this->render();
    }
}