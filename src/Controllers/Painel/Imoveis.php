<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;
use Models\Immobile;

class Imoveis extends Controller {
    protected Immobile $modelImoveis;

    public function __construct() {
        $this->modelImoveis = new Immobile(App::resolve(Database::class));
    }

    public function create() {
        $errors = $this->modelImoveis->validate();
        
        if(!empty($errors)){
            $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
            $redirectUrl .= strpos($redirectUrl, '?') === false ? '?' : '&';
            $redirectUrl .= http_build_query(['errors' => $errors]);
            header('Location: ' . $redirectUrl);
            exit();
        }
        
        $this->modelImoveis->create();

        $this->setAttribute("created", true);
        
        response()->redirect("/painel/imoveis", 201);
    }

    public function update(int $idImovel) {
       $errors = $this->modelImoveis->validate();
        
        if(!empty($errors)){
            $redirectUrl = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/';
            $redirectUrl .= strpos($redirectUrl, '?') === false ? '?' : '&';
            $redirectUrl .= http_build_query(['errors' => $errors]);
            header('Location: ' . $redirectUrl);
            exit;
        }
        
        $this->modelImoveis->update($idImovel);
        
        $this->setAttribute("updated", true);

        response()->redirect("/painel/imoveis", 200);
    }

    public function destroy(int $idImovel) {
        if(!$idImovel){
            return;
        }

        $this->modelImoveis->destroy($idImovel);
    }

    public function formEditar(int $idImovel) {
        if(isset($_GET['errors'])){
            $this->setAttribute("errors", $_GET['errors']);
            unset($_GET['errors']);
        }

        if(!$idImovel){
            return;
        }

        $imovel = $this->modelImoveis->find($idImovel);
        
        $this->setAttributes([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel/imoveis",
            "imovel" => $imovel
        ]);

        $this->render(Helpers::getPath("views")."/painel/imoveis/editar.view.php");
    }

    public function formCadastrar() {
        if(isset($_GET['errors'])){
            $this->setAttribute("errors", $_GET['errors']);
            unset($_GET['errors']);
        }
        
        $this->setAttributes([
            "navActiveUri" => "/painel/imoveis",
            "page_layout_css" => "painel"
        ]);

        $this->render(Helpers::getPath("views")."/painel/imoveis/cadastrar.view.php");
    }
    
    public function view() {
        $filter = null;

        if(isset($_GET['filter'])){
            $filter = $_GET['filter'];
            $this->setAttribute("filter", $_GET['filter']);
        }

        $imoveis = $this->modelImoveis->list($filter) ?? [];
        
        $this->setAttributes([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel/imoveis",
            "imoveis" => $imoveis
        ]);

        $this->render(Helpers::getPath("views")."/painel/imoveis/listar.view.php");
    }
}