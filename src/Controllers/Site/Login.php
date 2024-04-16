<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;

use Models\User;

class Login extends Controller {
    public function isAuthenticated() {
        // TODO: validate session token and user identification
        return $_SESSION["authenticated"] ?? false;
    }

    public function authenticate() {
        if ($this->isAuthenticated()) {
            $this->redirect("/painel");
        }

        $this->setView(Helpers::getPath("views")."/painel/login.view.php");
        $this->setAttribute("title", "Painel administrativo");

        $username = $_POST["username"] ?? "";
        $password = $_POST["password"] ?? "";

        if (empty($username) || empty($password)) {
            $this->setAttribute("login_error_message", "Preencha os campos usuário e senha.");
            $this->render();
        }

        $this->setModel(new User(App::resolve(Database::class)));
        
        // TODO: validate input
        if (!$this->model->compare($username, $password)) {
            $this->setAttribute("login_error_message", "Usuário e/ou senha inválidos.");
            $this->render();
        }

        // TODO: store session token and user identification
        $_SESSION["user"] = [
            "username" => $username, 
            "session_token" => null
        ];
        $_SESSION["authenticated"] = true;

        $this->redirect("/painel");
    }
    
    public function view() {
        if ($this->isAuthenticated()) {
            $this->redirect("/painel");
        }

        $this->setView(Helpers::getPath("views")."/painel/login.view.php");
        $this->setAttribute("title", "Acesso de colaboradores");
        $this->render();
    }
}