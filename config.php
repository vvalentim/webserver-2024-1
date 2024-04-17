<?php

return [
    "use_db" => getenv("USE_REMOTE_DB") ? "db_remoto" : "db_local",
    "db_remoto" => [
        "dsn" => getenv("DB_URI"),
        "username" => getenv("DB_USER"),
        "password" => getenv("DB_PASSWORD"),
    ],
    "db_local" => [
        "dsn" => "pgsql:host=127.0.0.1;port=5432;dbname=webserver_2024",
        "username" => "vvalentim",
        "password" => "dev",
    ]
];