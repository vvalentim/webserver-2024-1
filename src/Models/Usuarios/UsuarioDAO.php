<?php

namespace Models\Usuarios;

use Core\Database;

class UsuarioDAO {
    public function __construct(
        protected Database $db
    ) {}

    public function buscarTiposUsuario(): array {
        $query = "SELECT id, tipo FROM grupos_usuarios";
        
        return $this->db->query($query, [])->findAll();
    }

    public function buscar(string $identificador): mixed {
        $query = 
            "SELECT usuarios.id, grupos_usuarios.tipo, usuarios.nome, usuarios.email, usuarios.hash_senha FROM usuarios " .
            "JOIN grupos_usuarios ON (usuarios.id_grupo_usuario = grupos_usuarios.id) " .
            "WHERE usuarios.nome = :identificador OR usuarios.email = :identificador";

        $usuario = $this->db->query($query, [
            "identificador" => $identificador
        ])->find(Usuario::class);

        return $usuario;
    }
    
    public function cadastrar(array $dto): mixed {
        extract($dto);

        if ($this->buscar($nome)) {
            return false;
        }

        $query =
            "INSERT INTO usuarios (id_grupo_usuario, nome, email, hash_senha) " .
            "VALUES (" .
            "(SELECT id FROM grupos_usuarios WHERE tipo = :tipo), " .
            "(:nome), (:email), (:hash_senha) " .
            ")";

        $usuario = $this->db->query($query, [
            "tipo" => $tipo,
            "nome" => $nome,
            "email" => $email,
            "hash_senha" => password_hash($senha, PASSWORD_BCRYPT),
        ])->find(Usuario::class);

        return $usuario;
    }
}