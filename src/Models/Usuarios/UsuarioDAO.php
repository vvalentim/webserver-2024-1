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

    public function buscarTodos(): mixed {
        $query = 
            "SELECT usuarios.id, grupos_usuarios.tipo, usuarios.nome, usuarios.email, usuarios.hash_senha FROM usuarios " .
            "JOIN grupos_usuarios ON (usuarios.id_grupo_usuario = grupos_usuarios.id)";
        
        return $this->db->query($query, [])->findAll(Usuario::class);
    }

    public function buscar(string|int $identificador): mixed {
        $condicionalId = is_int($identificador) ? 
            "WHERE usuarios.id = :identificador" :
            "WHERE LOWER(usuarios.nome) = :identificador OR LOWER(usuarios.email) = :identificador";
        
        $query = 
            "SELECT usuarios.id, grupos_usuarios.tipo, usuarios.nome, usuarios.email, usuarios.hash_senha FROM usuarios " .
            "JOIN grupos_usuarios ON (usuarios.id_grupo_usuario = grupos_usuarios.id) " .$condicionalId;
            

        return $this->db->query($query, [
            "identificador" => is_int($identificador) ? $identificador : strtolower($identificador)
        ])->find(Usuario::class);
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

        return $this->db->query($query, [
            "tipo" => strtolower($tipo),
            "nome" => strtolower($nome),
            "email" => strtolower($email),
            "hash_senha" => password_hash($senha, PASSWORD_BCRYPT),
        ])->count();
    }

    public function atualizar(int $id, array $dto): int {
        $query = $this->db->buildUpdateQuery("usuarios", array_keys($dto))." WHERE id = :identificador";

        return $this->db->query($query, [
            ...$dto,
            "identificador" => $id,
        ])->count();
    }

    public function deletar(int $id): int {
        $query = "DELETE FROM usuarios WHERE id = :id";

        return $this->db->query($query, ["id" => $id])->count();
    }
}