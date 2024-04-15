<?php

use Core\Helpers;

error_reporting(E_ALL);
ini_set("display_errors", true);

require(__DIR__."/../src/autoload.php");

class Test {
    public function __construct(
        public mixed $fn,
        public string $desc,
        public bool $run = true,
    ) {}
}

function runTests(array $tests) {
    foreach ($tests as $testParams) {
        $test = new Test(...$testParams);
        
        if ($test->run) {
            Helpers::dump($test->desc);

            if (is_callable($test->fn)) {
                call_user_func($test->fn);
            }
        }
    }
}

require(__DIR__."/usuariosCrud.php");