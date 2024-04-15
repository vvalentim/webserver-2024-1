<?php

namespace Core;

class QueryBuilder {
    public static function select(string $table, array $fields = []): string {
        $query = empty($fields) ?
            "SELECT * FROM {$table}" :
            "SELECT ".join(", ", $fields)." FROM {$table}";

        return $query;
    }

    public static function insert(string $table, array $fields): string {
        $query = 
            "INSERT INTO {$table} (".
                join(", ", $fields).
            ") VALUES (".
                join(",", array_map(fn($field) => "(:{$field})", $fields)).
            ")";
        
        return $query;
    }

    public static function update(string $table, array $fields): string {
        $query = 
            "UPDATE {$table} SET ".join(", ", array_map(fn($field) => "{$field} = :{$field}", $fields));

        return $query;
    }
}