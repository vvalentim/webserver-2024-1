<?php

namespace Controllers\Site;

use Core\Controller;
use Core\Helpers;

final class Inicio extends Controller {
    public function __construct() {
        parent::__construct([
            "page_layout_css" => "site",
            "title" => "Imobiliária XYZ",
        ]);
    }
    public function index() {
        $this->render(view: "inicio", path: Helpers::getPath("views-site"));
    }
}