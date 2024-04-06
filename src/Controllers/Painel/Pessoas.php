<?php

namespace Controllers\Painel;

use Core\Controller;
use Core\Helpers;

class Pessoas extends Controller {
    public function editar() {
        // TODO: verificar se o id da pessoa existe
        $this->setView(Helpers::getPath("views")."/painel/pessoas/editar.php");
        $this->setAttribute("navActiveUri", "/painel/pessoas");
        $this->setAttribute("idPessoa", $this->httpParams["idPessoa"]);
        $this->render();
    }

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