<?php

return [
    "use_db" => "db_local",
    "db_local" => [
        "dsn" => "pgsql:host=127.0.0.1;port=5432;dbname=webserver_2024",
        "username" => "postgres",
        "password" => "0408",
    ],
    "db_utf" => [
        "dsn" => "mysql:host=127.0.0.1;port=3306;dbname=webserver_2024",
        "username" => "root",
        "password" => "",
    ]
];