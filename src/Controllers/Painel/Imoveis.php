<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;
use Models\Immobile;

class Imoveis extends Controller {

    // $pessoaModel = new Pessoa();

    public function editar() {
        // TODO: verificar se o id do imovel existe
        $this->setView(Helpers::getPath("views")."/painel/imoveis/editar.view.php");
        $this->setAttribute("navActiveUri", "/painel/imoveis");
        $this->setAttribute("idImovel", $this->httpParams["idImovel"]);
        $this->render();
    }

    public function cadastrar() {
        $this->setView(Helpers::getPath("views")."/painel/imoveis/cadastrar.view.php");
        $this->setAttribute("navActiveUri", "/painel/imoveis");
        $this->render();
    }

    public function view() {
        $this->setModel(new Immobile(App::resolve(Database::class)));

        $filter = null;
        if(isset($_GET['filter'])){
            $filter = $_GET['filter'];
            $this->setAttribute("filter", $_GET['filter']);
        }

        $imoveis = $this->model->list($filter) ?? [];
        $this->setAttributes("imoveis", $imoveis);

        $this->setView(Helpers::getPath("views")."/painel/imoveis/listar.view.php");
        $this->setAttribute("navActiveUri", "/painel/imoveis");
        $this->render();
    }

    public function create() {
        $this->setModel(new Immobile(App::resolve(Database::class)));

        // $errors = $this->model->validate();
        
        // if(!empty($errors)){
        //     $this->jsonResponse(true, $errors);
        // }
        
        $this->model->create();

        $this->setAttribute("created", true);
        $this->redirect("/painel/imoveis");
    }

    public function destroy() {
        $this->setModel(new Immobile(App::resolve(Database::class)));

        if(!isset($this->httpParams['idImovel'])){
            return null;
        }
        $this->model->destroy($this->httpParams['idImovel']);
    }
}