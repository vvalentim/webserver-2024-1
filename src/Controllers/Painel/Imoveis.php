<?php

namespace Controllers\Painel;

use Core\Controller;
use Models\Imoveis\Imovel;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

final class Imoveis extends Controller {
    public function __construct() {
        parent::__construct([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel/imoveis"
        ]);
    }

    public function formEditar(int $idImovel) {
        if ($idImovel) {
            $imovel = Imovel::findBy("id", $idImovel);

            if ($imovel) {
                $this->
                    setAttribute("title", "Painel - Editar imóvel")->
                    setAttribute("imovel", $imovel)->
                    render("editar");
            }
        }
        
        throw new NotFoundHttpException("O cadastro com id '{$idImovel}' não foi encontrado.");
    }

    public function formCadastrar() {
        $this->
            setAttribute("title", "Painel - Cadastrar imóvel")->
            render("cadastrar");
    }

    public function index() {
        $imoveis = Imovel::findAll();

        $this->
            setAttribute("title", "Painel - Imóveis")->
            setAttribute("imoveis", $imoveis)->
            render("listar");
    }
}