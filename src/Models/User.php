<?php

namespace Models;

use Core\Database;

class User {
    protected Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function findByUsername($username) {
        $user = $this->db->query("SELECT * FROM users WHERE username = :username", [
            "username" => $username,
        ])->find();

        return $user;
    }

    public function register($username, $password) {
        if ($this->findByUsername($username)) {
            return null;
        }

        $user = $this->db->query("INSERT INTO users (username, password) VALUES (:username, :password)", [
            "username" => $username,
            "password" => password_hash($password, PASSWORD_BCRYPT),
        ])->find();

        return $user;
    }

    public function compare($username, $password) {
        $user = $this->findByUsername($username);

        if (!$user) {
            return false;
        }

        return password_verify($password, $user["password"]);
    }
}