<?php

// Entry point for development when using the built-in web server from PHP.
// This script will be run on each request and decide if it should serve a static asset or "route" the request to a controller.
// Reference: https://www.php.net/manual/en/features.commandline.webserver.php
$uri = trim(urldecode(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)), "/");

if ($uri !== "" && file_exists(__DIR__."/public/{$uri}")) {
    return false;
}

require_once(__DIR__."/public/index.php");