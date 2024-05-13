<?php

namespace Controllers\Painel;

use Core\Controller;
use Models\Usuarios\Usuario;

final class Login extends Controller {
    public function __construct() {
        parent::__construct([
            "page_layout_css" => "painel",
        ]);
    }

    protected function autenticar() {
        $identificador = input()->post("identificador", "")->value;
        $senha = input()->post("senha", "")->value;

        if (!empty($identificador)) {
            $findBy = str_contains($identificador, "@") ? "email" : "username";
            $usuario = Usuario::findBy($findBy, $identificador);
            
            if ($usuario && $usuario->compararSenha($senha)) {
                $_SESSION["usuario"] = [
                    "id" => $usuario->id(), 
                    "username" => $usuario->username(),
                    "token_sessao" => null
                ];
        
                $_SESSION["autenticado"] = true;
                
                response()->redirect("/painel", 200);
            }
        }

        $this->setAttribute("login_error_message", "Usuário e/ou senha inválidos.");
    }

    public function sair() {
        if (isset($_SESSION["autenticado"])) {
            $_SESSION["usuario"] = [];
            $_SESSION["autenticado"] = false;
        }

        response()->redirect("/painel/logout", 200);
    }
    
    public function index() {
        if (request()->getMethod() === "post") {
            $this->autenticar();
        }

        $this->
            setAttribute("title", "Imobiliária XYZ - Acesso restrito")->
            render("login");
    }
}