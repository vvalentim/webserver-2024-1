<?php

namespace Core;

abstract class Controller {
    protected $viewPath;
    protected $httpMethod;
    protected $httpParams;

    protected $pageAttributes = [];

    protected abstract function run();
    
    protected function __construct($viewPath, $httpMethod, $httpParams) {
        $this->viewPath = $viewPath;
        $this->httpMethod = $httpMethod;
        $this->httpParams = $httpParams;

        $this->run();
    }

    protected function setAttribute($key, $value) {
        $this->pageAttributes[$key] = $value;
    }

    public function render() {
        extract($this->pageAttributes);

        require($this->viewPath);

        exit();
    }
}