<?php

namespace Controllers\Painel;

use Core\Controller;
use Core\Helpers;

final class Dashboard extends Controller {
    public function __construct() {
        parent::__construct([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel",
        ]);
    }

    public function index() {
        $this->
            setAttribute("title", "Painel - Início")->
            render(view: "dashboard", path: Helpers::getPath("views-painel"));
    }
}