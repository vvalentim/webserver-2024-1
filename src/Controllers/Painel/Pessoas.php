<?php

namespace Controllers\Painel;

use Core\Controller;
use Models\Pessoas\Pessoa;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

final class Pessoas extends Controller {
    public function __construct() {
        parent::__construct([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel/pessoas"
        ]);
    }

    public function formEditar(int $idPessoa) {
        if ($idPessoa) {
            $pessoa = Pessoa::findBy("id", $idPessoa);

            if ($pessoa) {
                $this->
                    setAttribute("title", "Painel - Editar pessoa")->
                    setAttribute("pessoa", $pessoa)->
                    render("editar");
            }
        }

        throw new NotFoundHttpException("O cadastro com id '{$idPessoa}' não foi encontrado.");
    }

    public function formCadastrar() {
        $this->
            setAttribute("title", "Painel - Cadastrar pessoa")->
            render("cadastrar");
    }
    
    public function index() {
        $pessoas = Pessoa::findAll();

        $this->
            setAttribute("title", "Painel - Pessoas")->
            setAttribute("pessoas", $pessoas)->
            render("listar");
    }
}