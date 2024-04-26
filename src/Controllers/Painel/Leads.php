<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;
use Models\LeadModel;

class Leads extends Controller {
    protected LeadModel $modelLeads;

    public function __construct() {
        $this->modelLeads = new LeadModel(App::resolve(Database::class));
    }

    public function destroy(int $idLead) {
        if(!$idLead){
            return null;
        }

        $this->modelLeads->destroy($idLead);
    }

    public function view() {
        $leads = $this->modelLeads->get() ?? [];

        $this->setAttributes([
            "page_layout_css" => "painel",
            "navActiveUri" => "/painel/leads",
            "leads" => $leads
        ]);
        
        $this->render(Helpers::getPath("views")."/painel/leads/listar.view.php");
    }
}