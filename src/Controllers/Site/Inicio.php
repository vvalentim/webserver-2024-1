<?php

namespace Controllers\Site;

use Core\Controller;
use Core\Helpers;

class Inicio extends Controller {
    public function view() {
        $this->setAttributes(["page_layout_css" => "site"]);
        $this->render(Helpers::getPath("views")."/site/inicio.view.php");
    }
}