<?php

namespace Controllers\Painel;

use Core\Controller;
use Models\Usuarios\Usuario;

final class Usuarios extends Controller {
    public function __construct() {
        parent::__construct([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel/usuarios"
        ]);
    }

    public function index() {
        $usuarios = Usuario::findAll();

        $this->
            setAttribute("title", "Painel - Usuários")->
            setAttribute("usuarios", $usuarios)->
            render("listar");
    }
}