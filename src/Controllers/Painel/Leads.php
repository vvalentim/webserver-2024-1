<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;
use Models\LeadModel;

class Leads extends Controller {
    public function __construct(
        protected string $httpMethod, 
        protected array $httpParams,
    ) {
        parent::__construct($httpMethod, $httpParams);

        // TODO: middleware de autenticação/autorização
        if (!Login::autenticado()) {
            parent::redirect("/painel/login", 401);
        }
    }

    public function destroy() {
        $this->setModel(new LeadModel(App::resolve(Database::class)));

        if(!isset($this->httpParams['idLead'])){
            return null;
        }
        $this->model->destroy($this->httpParams['idLead']);
    }

    public function view() {
        $this->setModel(new LeadModel(App::resolve(Database::class)));
        
        $this->setAttribute("page_layout_css", "painel");
        $this->setView(Helpers::getPath("views")."/painel/leads/listar.view.php");
        $this->setAttribute("navActiveUri", "/painel/leads");

        $leads = $this->model->get() ?? [];

        $this->setAttributes("leads", $leads);
        $this->render();
    }
}