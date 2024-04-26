<?php

namespace Controllers\Painel;

use Core\Controller;
use Core\Helpers;

class Inicio extends Controller {
    public function view() {
        $this->setAttributes([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel",
        ]);
        
        $this->render(Helpers::getPath("views")."/painel/inicio.view.php");
    }
}