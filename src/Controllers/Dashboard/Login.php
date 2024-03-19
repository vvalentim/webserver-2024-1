<?php

namespace Controllers\Dashboard;

use Core\Controller;

class Login extends Controller {
    public function __construct($method, $params) {
        parent::__construct(
            __DIR__."/../../views/dashboard/login.view.php", 
            $method, 
            $params
        );
    }
    public function authorize() {}
    
    public function run() {
        // TODO: handle authentication
        // TODO: redirect authenticated users

        $this->setAttribute("title", "Acesso ao painel administrativo");
        $this->setAttribute("login_error_message", "Credenciais inválidas.");
        $this->render();
    }
}