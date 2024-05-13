<?php

namespace Models\Pessoas;

use Core\ActiveRecord;
use DateTime;
use Throwable;

/**
 * @method string nome()
 * @method string documento()
 * @method string documentoTipo()
 * @method string cep()
 * @method string enderecoNumero()
 * @method string enderecoComplemento()
 * 
 * @method Pessoa setNome(string $nome)
 * @method Pessoa setDocumento(string $documento)
 * @method Pessoa setDocumentoTipo(string $documentoTipo)
 * @method Pessoa setEnderecoNumero(string $enderecoNumero)
 * @method Pessoa setEnderecoComplemento(string $enderecoComplemento)
 * @method Pessoa setTelefones(array $telefones)
 */
final class Pessoa extends ActiveRecord {
    protected const TABLE = "pessoas";

    protected string $nome;
    protected string $documento;
    protected string $documento_tipo;
    protected string $nascimento;
    protected string $cep;
    protected string $endereco_numero;
    protected string $endereco_complemento;
    protected array $telefones;

    public function setDocumento(string $documento): Pessoa {
        $this->documento = preg_replace("/\D/", "", $documento);
        
        return $this;
    }

    public function setNascimento(string $data): Pessoa {
        $this->nascimento = DateTime::createFromFormat("d/m/Y", $data)->format("Y-m-d");

        return $this;
    }

    public function setCep(string $cep): Pessoa {
        $this->cep = preg_replace("/\D/", "", $cep);

        return $this;
    }

    public function setEndereco(string $cep, string $numero, string $complemento): Pessoa {
        $this->endereco_numero = $numero;
        $this->endereco_complemento = $complemento;

        return $this->setCep($cep);
    }

    public function tipoPessoa(): ?string {
        return match($this->documento_tipo) {
            "F" => "Pessoa Física",
            "J" => "Pessoa Jurídica",
            default => null,
        };
    }

    public function nascimento(): string {
        return DateTime::createFromFormat("Y-m-d", $this->nascimento)->format("d/m/Y");
    }

    public function telefones(): array {
        if (empty($telefones)) {
            $this->telefones = $this->fetchTelefones();
        }

        return $this->telefones;
    }

    protected function fetchTelefones(): array {
        $telefones = [];

        if (!empty($this->id)) {
            $query = "SELECT numero_telefone FROM telefones WHERE id_pessoa = :id_pessoa";
            $params = ["id_pessoa" => $this->id];

            $stmt = static::runQuery($query, $params);
            $result = $stmt->fetchAll();

            if (!empty($result)) {
                $telefones = array_map(fn($row) => $row->numero_telefone, $result);
            }
        }

        return $telefones;
    }

    protected function clearTelefones(): bool {
        if (!empty($this->id)) {
            $query = "DELETE FROM telefones WHERE id_pessoa = :id_pessoa";
            $params = ["id_pessoa" => $this->id];

            $stmt = static::runQuery($query, $params);

            return $stmt->rowCount();
        }

        return false;
    }

    protected function addTelefones(): bool {
        if (!empty($this->id) && !empty($this->telefones)) {
            $values = array_map(fn() => "({$this->id}, ?)", $this->telefones);
            $values = join(", ", $values);

            $query = "INSERT INTO telefones (id_pessoa, numero_telefone) VALUES {$values}";
            $params = [...$this->telefones];

            $stmt = static::runQuery($query, $params);

            return $stmt->rowCount();
        }

        return false;
    }
    
    protected function create(): bool {
        $conn = static::db()->connection;

        try {
            $conn->beginTransaction();

            $table = static::TABLE;
            $columns = $this->getRecordCols();
            $query =
                "INSERT INTO {$table} (".
                    join(", ", $columns).
                ") VALUES (".
                    join(", ", array_map(fn($col) => ":{$col}", $columns)).
                ")";

            $params = $this->getQueryParams($columns);
            
            $stmt = static::runQuery($query, $params);

            if ($stmt->rowCount()) {
                $this->id = $conn->lastInsertId();
                $this->addTelefones();
            }

            $conn->commit();
        } catch (Throwable $e) {
            $conn->rollBack();
            $this->id = null;

            throw $e;
        }

        return true;
    }

    protected function update(): bool {
        if (empty($this->id)) {
            return $this->create();
        }

        $conn = static::db()->connection;

        try {
            $conn->beginTransaction();

            $table = static::TABLE;
            $columns = $this->getRecordCols();
            $query = 
                "UPDATE {$table} SET ".
                    join(", ", array_map(fn($col) => "{$col} = :{$col}", $columns)).
                " WHERE id = :id";

            $params = $this->getQueryParams([...$columns, "id"]);

            $stmt = static::runQuery($query, $params);

            if ($stmt->rowCount()) {
                $telefonesDb = $this->fetchTelefones();
                    
                if ($telefonesDb !== $this->telefones) {
                    $this->clearTelefones();
                    $this->addTelefones();
                }
            }

            $conn->commit();
        } catch (Throwable $e) {
            $conn->rollBack();

            throw $e;
        }

        return true;
    }
}