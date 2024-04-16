<?php

use Core\Helpers;
use Core\Database;
use Models\Usuarios\AtualizarUsuarioDTO;
use Models\Usuarios\CadastroUsuarioDTO;
use Models\Usuarios\FiltrosBuscaDTO;
use Models\Usuarios\UsuariosDAO;

$config = require(__DIR__."/../config.php");
$use_db = $config["use_db"];

$daoUsuarios = new UsuariosDAO(Database::getInstance($config[$use_db]));

runTests([
    # Buscar usuário
    [
        "fn" => function() use (&$daoUsuarios) {
            Helpers::dump($daoUsuarios->buscar("joaozinho"));
        },
        "desc" => "Buscar usuário...",
        "run" => false,
    ],
    # Busca de usuário com filtros
    [
        "fn" => function() use (&$daoUsuarios) {
            
            $dto = new FiltrosBuscaDTO(tipo: "corretor");
            Helpers::dump($daoUsuarios->buscarComFiltros($dto));
        },
        "desc" => "Busca de usuário com filtros...",
        "run" => false,
    ],
    # Listar tipos usuários
    [
        "fn" => function() use (&$daoUsuarios) {
            Helpers::dump($daoUsuarios->buscarTiposUsuario());
        },
        "desc" => "Listar tipos usuários...",
        "run" => false,
    ],
    # Listar usuários
    [
        "fn" => function() use (&$daoUsuarios) {
            Helpers::dump($daoUsuarios->buscarTodos());
        },
        "desc" => "",
        "run" => false,
    ],
    # Deletar usuário
    [
        "fn" => function() use (&$daoUsuarios) {
            Helpers::dump($daoUsuarios->deletar(13));
        },
        "desc" => "Deletar usuário...",
        "run" => false,
    ], 
    # Cadastrar usuário
    [
        "fn" => function() use (&$daoUsuarios) {
            $dto = new CadastroUsuarioDTO(
                tipo_usuario: "administrador", 
                nome: "joao", 
                email: "joao@uol.com", 
                senha: "123abc"
            );
            Helpers::dump($daoUsuarios->cadastrar($dto));
        },
        "desc" => "Cadastrar usuário...",
        "run" => false,
    ],
    # Atualizar usuário
    [
        "fn" => function() use (&$daoUsuarios) {
            $dto = new AtualizarUsuarioDTO(id: 14, nome: "felipecom");
            Helpers::dump($daoUsuarios->atualizar($dto));
        },
        "desc" => "Atualizar usuário...",
        "run" => false,
    ],
]);






