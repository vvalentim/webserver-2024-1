<?php

error_reporting(E_ALL);
ini_set("display_errors", true);

require_once(__DIR__."/../vendor/autoload.php");
require_once(__DIR__."/../config.php");
require_once(__DIR__."/../src/bootstrap.php");

use Core\Helpers;

class Test {
    public function __construct(
        public mixed $fn,
        public string $desc = "",
        public bool $run = true,
    ) {}
}

function runTests(array $tests) {
    foreach ($tests as $testParams) {
        $test = new Test(...$testParams);
        
        if ($test->run) {
            if (!empty($test->desc)) {
                Helpers::dump($test->desc);
            }

            if (is_callable($test->fn)) {
                call_user_func($test->fn);
            }
        }
    }
}