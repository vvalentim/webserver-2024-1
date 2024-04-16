<?php

namespace Controllers\Site;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;

use Models\LeadModel;

class Lead extends Controller {

    public function view(){
        return;
    }

    public function create() {
        $this->setModel(new LeadModel(App::resolve(Database::class)));
        
        $errors = $this->model->validate();

        if(!empty($errors)){
            echo $this->jsonResponse(true, $errors);
            return;
        }
        
        $response = $this->model->create();
        echo $this->jsonResponse(false, []);
    }
}