<?php

namespace Controllers\Site;

use Core\App;
use Core\Controller;
use Core\Database;
use Models\LeadModel;

class Lead extends Controller {
    protected LeadModel $modelLeads;

    public function __construct() {
        $this->modelLeads = new LeadModel(App::resolve(Database::class));
    }

    public function create() {
        $errors = $this->modelLeads->validate();

        if(!empty($errors)){
            response()->json([
                "error" => true,
                "message" => $errors,
            ]);
        }
        
        $this->modelLeads->create();
        
        response()->json([
            "error" => false,
            "message" => [],
        ]);
    }

    public function view() {}
}