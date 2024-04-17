<?php

namespace Models\Usuarios;

use Core\Database;
use Core\Helpers;
use Core\QueryBuilder;
use Exception;
use PDOException;

class UsuariosDAO {
    public function __construct(
        protected Database $db
    ) {}

    public function buscarTiposUsuario(): array {
        $query = "SELECT id, tipo FROM grupos_usuarios ORDER BY id ASC";
        
        return $this->db->query($query, [])->findAll();
    }

    public function buscarTodos(): array|bool {
        $query = 
            "SELECT usuarios.* FROM usuarios ".
            "JOIN grupos_usuarios ON (usuarios.id_grupo_usuario = grupos_usuarios.id) ".
            "ORDER BY usuarios.id ASC";
        
        $usuarios = $this->db->query($query, [])->findAll(Usuario::class);
        
        return $usuarios;
    }
    
    public function buscarComFiltros(FiltrosBuscaDTO $dto): array|bool {
        $condicionais = [];
        $parametros = [];

        if (!empty($dto->nome)) {
            $condicionais[] = "usuarios.nome ILIKE CONCAT('%', (:nome::VARCHAR), '%')";
            $parametros["nome"] = $dto->nome;
        }

        if (!empty($dto->email)) {
            $condicionais[] = "usuarios.email ILIKE CONCAT('%', (:email::VARCHAR), '%')";
            $parametros["email"] = $dto->email;
        }

        if (!empty($dto->tipo)) {
            $condicionais[] = "grupos_usuarios.tipo = :tipo";
            $parametros["tipo"] = $dto->tipo;
        }

        $condicionais = join(" AND ", $condicionais);

        $query = 
            "SELECT usuarios.*, grupos_usuarios.tipo FROM usuarios " .
            "JOIN grupos_usuarios ON (usuarios.id_grupo_usuario = grupos_usuarios.id) " .
            "WHERE ".$condicionais." ORDER BY usuarios.id ASC";

        $usuarios = $this->db->query($query, $parametros)->findAll(Usuario::class);

        return $usuarios;
    }

    public function buscar(string|int $identificador): Usuario|null {
        $condicional = is_int($identificador) ? 
            "WHERE usuarios.id = :identificador" :
            "WHERE LOWER(usuarios.nome) = :identificador OR LOWER(usuarios.email) = :identificador";
        
        $query = 
            "SELECT usuarios.*, grupos_usuarios.tipo FROM usuarios ".
            "JOIN grupos_usuarios ON (usuarios.id_grupo_usuario = grupos_usuarios.id) ".$condicional;
            
        $usuario = $this->db->query($query, [
            "identificador" => is_int($identificador) ? $identificador : strtolower($identificador)
        ])->find(Usuario::class);

        if ($usuario instanceof Usuario) {
            return $usuario;
        }

        return null;
    }
    
    public function cadastrar(CadastroUsuarioDTO $dto): Usuario|null {
        $resultado = null;

        $query =
        "INSERT INTO usuarios (id_grupo_usuario, nome, email, hash_senha) ".
        "VALUES (" .
            "(SELECT id FROM grupos_usuarios WHERE tipo = :tipo), ".
            "(:nome), (:email), (:hash_senha) ".
        ")";

        try {
            $idUsuario = $this->db->query($query, [
                "tipo" => $dto->tipo_usuario,
                "nome" => $dto->nome,
                "email" => $dto->email,
                "hash_senha" => password_hash($dto->senha, PASSWORD_BCRYPT),
            ])->lastInsertId();

            if (!empty($idUsuario)) {
                $resultado = $this->buscar((int) $idUsuario);
            }
        } catch (PDOException $e) {
            // Tratar apenas se a exceção for relacionada as restrições de chave única
            if ($e->getCode() !== "23505") {
                throw new Exception($e->getMessage());
            }
        }

        return $resultado;
    }

    public function atualizar(AtualizarUsuarioDTO $dto): Usuario|null {
        $set = [];
        $parametros = [];
        $resultado = null;

        // Filtra as propriedades vazias e e define a query/campos para atualizar
        foreach(array_filter(get_object_vars($dto)) as $propriedade => $valor) {
            if ($propriedade === "tipo_usuario") {
                $set[] = "id_grupo_usuario = (SELECT id FROM grupos_usuarios WHERE tipo = :tipo)";
                $parametros["tipo"] = $valor;
            } else {
                $set[] = "{$propriedade} = :{$propriedade}";
                $parametros[$propriedade] = $valor;
            }
        }

        $query = 
            "UPDATE usuarios ".
            "SET ".join(", ", $set)." ".
            "WHERE id = :identificador";
            
        try {
            $alterou = $this->db->query($query, [
                ...$parametros,
                "identificador" => $dto->id(),
            ])->count();

            if ($alterou) {
                $resultado = $this->buscar($dto->id());
            }
        } catch (PDOException $e) {
            // Tratar apenas se a exceção for relacionada as restrições de chave única
            if ($e->getCode() !== "23505") {
                throw new Exception($e->getMessage());
            }
        }

        return $resultado;
    }

    public function deletar(int $id): bool {
        $query = "DELETE FROM usuarios WHERE id = :id";

        return $this->db->query($query, ["id" => $id])->count();
    }
}