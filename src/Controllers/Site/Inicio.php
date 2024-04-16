<?php

namespace Controllers\Site;

use Core\Controller;
use Core\Helpers;

class Inicio extends Controller {
    public function view() {
        $this->setAttribute("page_layout_css", "site");
        $this->setView(Helpers::getPath("views")."/site/inicio.view.php");
        $this->render();
    }
}