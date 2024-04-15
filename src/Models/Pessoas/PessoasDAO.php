<?php

namespace Models\Pessoas;

use Core\Database;
use Core\Helpers;
use Core\QueryBuilder;
use Exception;
use PDOException;

class PessoasDAO {
    public function __construct(
        protected Database $db
    ) {}

    public function buscarTelefones(int $idPessoa): array|bool {
        $query = "SELECT * FROM telefones WHERE id_pessoa = :id_pessoa ORDER BY id ASC";
        $telefones = $this->db->query($query, ["id_pessoa" => $idPessoa])->findAll(Telefone::class);

        return $telefones;
    }

    public function buscarTodos(): array|bool {
        $query = "SELECT * FROM pessoas ORDER BY id ASC";

        $pessoas = $this->db->query($query, [])->findAll(Pessoa::class);

        foreach ($pessoas as $pessoa) {
            $pessoa->telefones = $this->buscarTelefones($pessoa->id);
        }

        return $pessoas;
    }

    public function buscarComFiltros(FiltrosBuscaDTO $dto): array|bool {
        $condicionais = [];
        $parametros = [];

        if (!empty($dto->nome_razao)) {
            $condicionais[] = "pessoas.nome_razao ILIKE CONCAT('%', :nome_razao::VARCHAR, '%')";
            $parametros["nome_razao"] = $dto->nome_razao;
        }

        if (!empty($dto->tipo_pessoa)) {
            $condicionais[] = "pessoas.tipo_pessoa = :tipo_pessoa";
            $parametros["tipo_pessoa"] = $dto->tipo_pessoa;
        }

        if (!empty($dto->tipo_vinculo)) {
            $condicionais[] = "pessoas.tipo_vinculo = :tipo_vinculo";
            $parametros["tipo_vinculo"] = $dto->tipo_vinculo;
        }

        if (!empty($dto->telefone)) {
            $condicionais[] = "telefones.numero LIKE CONCAT('%', :telefone::VARCHAR, '%')";
            $parametros["telefone"] = $dto->telefone;
        }

        $condicionais = join(" AND ", $condicionais);

        $query = 
            "SELECT pessoas.* FROM pessoas " .
            "JOIN telefones ON (telefones.id_pessoa = pessoas.id) " .
            "WHERE ".$condicionais." GROUP BY pessoas.id ".
            "ORDER BY pessoas.id ASC";

        $pessoas = $this->db->query($query, $parametros)->findAll(Pessoa::class);
        
        foreach($pessoas as $pessoa) {
            $pessoa->telefones = $this->buscarTelefones($pessoa->id);
        }

        return $pessoas;
    }

    public function buscar(string|int $identificador): Pessoa|null {
        $condicional = is_int($identificador) ?
            "WHERE id = :identificador" :
            "WHERE documento = :identificador";
        
        $query = "SELECT * FROM pessoas ".$condicional;

        $pessoa = $this->db->query($query, [
            "identificador" => $identificador,
        ])->find(Pessoa::class);
        
        if ($pessoa instanceof Pessoa) {
            $pessoa->telefones = $this->buscarTelefones($pessoa->id);

            return $pessoa;
        }

        return null;
    }

    public function cadastrar(CadastroPessoaDTO $dto): Pessoa|null {
        $resultado = null;

        try {
            $resultado = $this->db->runInTransaction(function() use (&$dto) {
                $parametros = get_object_vars($dto); 
                $queryPessoa = QueryBuilder::insert("pessoas", array_keys($parametros));
                $idPessoa = $this->db->query($queryPessoa, $parametros)->lastInsertId();

                if (!empty($idPessoa)) {
                    // Monta a query com os valores seguido de id_pessoa, numero
                    $valores = array_map(
                        fn() => "({$idPessoa}, ?)", 
                        $dto->telefones()
                    );
                    
                    $queryTelefones =
                        "INSERT INTO telefones (id_pessoa, numero) ".
                        "VALUES ".join(", ", $valores);
                        
                    $this->db->query($queryTelefones, $dto->telefones());

                    return $this->buscar((int) $idPessoa);
                }

                return null;
            });
        } catch (PDOException $e) {
            // Tratar apenas se a exceção for relacionada as restrições de chave única
            if ($e->getCode() !== "23505") {
                throw new Exception($e->getMessage());
            }
        }

        return $resultado;
    }

    public function atualizar(AtualizarPessoaDTO $dto): Pessoa|null {
        $resultado = null;

        try {
            $resultado = $this->db->runInTransaction(function() use (&$dto) {
                $set = [];
                $parametros = [];

                // Filtra as propriedades vazias e e define a query/campos para atualizar
                foreach(array_filter(get_object_vars($dto)) as $propriedade => $valor) {
                    $set[] = "{$propriedade} = :{$propriedade}";
                    $parametros[$propriedade] = $valor;
                }
                
                $queryPessoa = 
                    "UPDATE pessoas ".
                    "SET ".join(", ", $set)." ".
                    "WHERE id = :identificador";

                $alterouPessoa = $this->db->query($queryPessoa, [
                    ...$parametros,
                    "identificador" => $dto->id(),
                ])->count();

                $alterouTelefones = 0;

                // Verifica se será necessário alterar os telefones
                if (count($dto->telefones())) {
                    // Deleta os registros existentes para realizar a inclusão da nova lista
                    $this->db->query(
                        "DELETE FROM telefones WHERE id_pessoa = :id_pessoa",
                        ["id_pessoa" => $dto->id()],
                    );

                    // Monta os valores da query seguido de id_pessoa, numero
                    $valores = array_map(
                        fn() => "({$dto->id()}, ?)", 
                        $dto->telefones(),
                    );
                    
                    $queryTelefones =
                        "INSERT INTO telefones (id_pessoa, numero) ".
                        "VALUES ".join(", ", $valores);
                        
                    $alterouTelefones = $this->db->query(
                        $queryTelefones, 
                        $dto->telefones()
                    )->count();
                }

                // Verifica se houve alguma alteração para retornar o registro
                if ($alterouPessoa || $alterouTelefones) {
                    return $this->buscar($dto->id());
                }
            });
        } catch (PDOException $e) {
            // Tratar apenas se a exceção for relacionada as restrições de chave única
            if ($e->getCode() !== "23505") {
                throw new Exception($e->getMessage());
            }
        }
        
        return $resultado;
    }

    public function deletar(int $id): int {
        $query = "DELETE FROM pessoas WHERE id = :id";

        return $this->db->query($query, ["id" => $id])->count();
    }
}