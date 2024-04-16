<?php

namespace Controllers\Painel;

use Core\App;
use Core\Controller;
use Core\Helpers;
use Models\Usuarios\Usuario;
use Models\Usuarios\UsuariosDAO;

class Login extends Controller {
    public static function autenticado() {
        // TODO: verificar se o token de sessão ainda é válido
        return $_SESSION["autenticado"] ?? false;
    }

    public function autenticar() {
        if (static::autenticado()) {
            $this->redirect("/painel");
        }

        $this->setView(Helpers::getPath("views")."/painel/login.view.php");
        $this->setAttribute("title", "Painel administrativo");

        $identificador = $_POST["identificador"] ?? "";
        $senha = $_POST["senha"] ?? "";
        $daoUsuario = new UsuariosDAO(App::resolve(\Core\Database::class));
        
        if (!Usuario::validarLogin($identificador, $senha)) {
            $this->setAttribute("login_error_message", "Usuário e/ou senha inválidos.");
            $this->render();
        }

        $usuario = $daoUsuario->buscar($identificador);

        if (
            !$usuario ||
            !password_verify($senha, $usuario->hash_senha)
        ) {
            $this->setAttribute("login_error_message", "Usuário e/ou senha inválidos.");
            $this->render();
        }

        // TODO: gerar token de sessão
        $_SESSION["usuario"] = [
            "id_usuario" => $usuario->id(), 
            "token_sessao" => null
        ];
        $_SESSION["autenticado"] = true;

        $this->redirect("/painel");
    }
    
    public function view() {
        if ($this->autenticado()) {
            $this->redirect("/painel");
        }

        $this->setView(Helpers::getPath("views")."/painel/login.view.php");
        $this->setAttribute("title", "Acesso de colaboradores");
        $this->render();
    }
}