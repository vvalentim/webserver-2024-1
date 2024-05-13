<?php

namespace Core;

use Core\Enums\IntegrityExceptionCode;
use Core\Exceptions\IntegrityConstraintException;
use Core\Traits\CallableGetSet;
use PDO;
use PDOException;
use PDOStatement;

abstract class ActiveRecord {
    use CallableGetSet;
    
    protected const TABLE = null;
    protected ?int $id;

    public function id(): ?int {
        return $this->id ?? null;
    }

    public static function fromRequestParams(array $params): static {
        $record = new static();
        
        foreach($params as $key => $value) {
            if ($key !== "id") {
                $key = ucfirst($key);
                $setter = "set{$key}";
                
                $record->$setter($value);
            }
        }

        return $record;
    }

    protected static function db(): Database {
        return App::resolve(Database::class);
    }

    protected static function runQuery(string $query, array $params): PDOStatement|false {
        try {
            $conn = static::db()->connection;
            $stmt = $conn->prepare($query);
            $stmt->execute($params);

            return $stmt;
        } catch (PDOException $e) {
            if (IntegrityExceptionCode::tryFrom($e->getCode())) {
                throw new IntegrityConstraintException(previous: $e);
            }

            throw $e;
        }
    }

    protected function getRecordCols(): array {
        $properties = array_filter(get_object_vars($this), fn($value, $key) => is_scalar($value) && $key !== "id", ARRAY_FILTER_USE_BOTH);

        return array_keys($properties);
    }

    protected function getQueryParams(array $columns): array {
        return array_merge(
            ...array_map(fn($col) => [$col => $this->$col], $columns),
        );
    }

    public function toArray(bool $callGetters = true): array {
        $props = array_keys(get_object_vars($this));

        return array_reduce($props, function($array, $prop) use (&$callGetters) {
            $key = Helpers::snakeToCamel($prop);
            $value = $callGetters ? $this->$key() : $this->$prop;

            $array[$key] = $value;

            return $array;
        }, []);
    }
    
    public static function findBy(string $column, string|int $value, array $fields = ["*"]): static|false {
        $table = static::TABLE;
        $fields = join(", ", $fields);

        $query = "SELECT {$fields} FROM {$table} WHERE {$column} = :{$column} ORDER BY id";

        $params = [$column => $value];

        $stmt = static::runQuery($query, $params);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetch();
    }

    /**
     * @return static[]
     */
    public static function findAll(array $fields = ["*"]) {
        $table = static::TABLE;
        $fields = join(", ", $fields);

        $query = "SELECT {$fields} FROM {$table} ORDER BY id";

        $stmt = static::runQuery($query, []);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetchAll();
    }
    
    /**
     * @return static[]|false
     */
    public static function findWhere(array $filters, array $fields = ["*"], string $operator = "AND") {
        $table = static::TABLE;
        $fields = join(", ", $fields);

        $columns = array_keys($filters);
        $query = 
            "SELECT {$fields} FROM {$table} ". 
            "WHERE (". 
                join(" {$operator} ", array_map(fn($col) => "{$col} = :{$col}", $columns)).
            ") ORDER BY id";

        $stmt = static::runQuery($query, $filters);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetchAll();
    }

    /**
     * @return static[]
     */
    public static function findLike(array $filters, array $fields = ["*"]) {
        $table = static::TABLE;
        $fields = join(", ", $fields);

        $columns = array_keys($filters);
        $query = 
            "SELECT {$fields} FROM {$table} WHERE (". 
                join(" OR ", array_map(fn($col) => "{$col} ILIKE CONCAT('%', (:{$col}::VARCHAR), '%')", $columns)).
            ") ORDER BY id";

        $stmt = static::runQuery($query, $filters);
        $stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

        return $stmt->fetchAll();
    }

    protected function create(): bool {
        $conn = static::db()->connection;
        $result = 0;
        
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
        $result = $stmt->rowCount();

        if ($result) {
            $this->id = $conn->lastInsertId();
        }

        return $result;
    }

    protected function update(): bool {
        $table = static::TABLE;
        $columns = $this->getRecordCols();
        $query = 
            "UPDATE {$table} SET ".
                join(", ", array_map(fn($col) => "{$col} = :{$col}", $columns)).
            " WHERE id = :id";

        $params = $this->getQueryParams([...$columns, "id"]);

        $stmt = static::runQuery($query, $params);

        return $stmt->rowCount();
    }

    public function save(): bool {
        return empty($this->id) ?
            $this->create() : 
            $this->update();
    }
    
    public function delete(): bool {
        $result = 0;

        if (!empty($this->id)) {
            $table = static::TABLE;
            $query = "DELETE FROM {$table} WHERE id = :id";
            $params = ["id" => $this->id];

            $stmt = static::runQuery($query, $params);

            $result = $stmt->rowCount();

            if ($result) {
                $this->id = null;
            }
        }

        return $result;
    }
}