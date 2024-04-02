<?php

namespace Core;

abstract class Controller {
    protected $view;

    protected $model;

    protected $httpMethod;

    protected $httpParams;
    
    protected $pageAttributes = [];

    public abstract function view();
    
    protected function __construct($view, $model, $httpMethod, $httpParams) {
        $this->view = $view;
        $this->model = $model;
        $this->httpMethod = $httpMethod;
        $this->httpParams = $httpParams;
    }

    protected function getHttpParam($key): string|null {
        return $this->httpParams[$key] ?? null;
    }

    protected function setAttribute($key, $value): void {
        $this->pageAttributes[$key] = $value;
    }

    protected function redirect($uri, $code = 302): void {
        http_response_code($code);
        
        header("Location: {$uri}");
        
        exit();
    }

    protected function render(): void {
        extract($this->pageAttributes);

        require($this->view);

        exit();
    }
}