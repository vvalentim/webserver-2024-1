<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Database;
use Core\Helpers;
use Exception;
use Models\Usuarios\Usuario;
use Models\Usuarios\UsuariosDAO;
use Throwable;

class Login extends Controller {
    protected function autenticar() {
        $identificador = input()->post("identificador", "")->value;
        $senha = input()->post("senha", "")->value;
        
        if (!Usuario::validarLogin($identificador, $senha)) {
            throw new Exception("Usuário e/ou senha inválidos.");
        }

        $daoUsuario = new UsuariosDAO(App::resolve(Database::class));
        $usuario = $daoUsuario->buscar($identificador);

        if (!$usuario || !password_verify($senha, $usuario->hash_senha)) {
            throw new Exception("Usuário e/ou senha inválidos.");
        }

        // TODO: gerar token de sessão
        $_SESSION["usuario"] = [
            "id_usuario" => $usuario->id(), 
            "nome" => $usuario->nome,
            "token_sessao" => null
        ];

        $_SESSION["autenticado"] = true;

        response()->redirect("/painel", 200);
    }

    public function sair() {
        if (isset($_SESSION["autenticado"])) {
            // TODO: invalidar o token de sessão
            $_SESSION["usuario"] = [];
            $_SESSION["autenticado"] = false;
        }

        response()->redirect("/painel/logout", 200);
    }
    
    public function view() {
        $this->setAttributes([
            "page_layout_css" => "painel", 
            "title" => "Acesso de colaboradores"
        ]);

        if (request()->getMethod() === "post") {
            try {
                $this->autenticar();
            } catch (Throwable $e) {
                // TODO: criar exceções de login
                // TODO: tratar as exceções de login
                $this->setAttribute("login_error_message", $e->getMessage());
            }
        }

        $this->render(Helpers::getPath("views")."/painel/login.view.php");
    }
}