<?php

// This script will load the environment variables when using Apache or the PHP Built-in webserver
if (!isset($_ENV["VERCEL_ENV"])) {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
}
