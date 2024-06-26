<?php

namespace Controllers\Painel;

use Core\Controller;
use Models\Leads\Lead;

final class Leads extends Controller {
    public function __construct() {
        parent::__construct([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel/leads"
        ]);
    }

    public function index() {
        $leads = Lead::findAll();

        $this->
            setAttribute("title", "Painel - Leads")->
            setAttribute("leads", $leads)->
            render("listar");
    }
}