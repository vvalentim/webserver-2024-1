<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;
use Models\LeadModel;

class Leads extends Controller {
    public function destroy() {
        $this->setModel(new LeadModel(App::resolve(Database::class)));

        if(!isset($this->httpParams['idLead'])){
            return null;
        }
        $this->model->destroy($this->httpParams['idLead']);
    }

    public function view() {
        $this->setModel(new LeadModel(App::resolve(Database::class)));
        
        $this->setView(Helpers::getPath("views")."/painel/leads/listar.view.php");
        $this->setAttribute("navActiveUri", "/painel/leads");
        
        $leads = $this->model->get() ?? [];
        $this->setAttributes("leads", $leads);
        $this->render();
    }
}