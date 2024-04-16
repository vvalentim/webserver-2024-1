<?php

namespace Controllers\Site;

use Core\Controller;
use Core\Helpers;

class Inicio extends Controller {
    public function view() {
        $this->setView(Helpers::getPath("views")."/site/inicio.view.php");
        $this->setAttribute("navActiveUri", "/painel");
        $this->render();
    }
}