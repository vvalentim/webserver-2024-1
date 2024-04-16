<?php

namespace Core;

abstract class Controller {
    protected $view;

    protected $model;
    
    protected $pageAttributes = [];

    public abstract function view();
    
    public function __construct(
        protected string $httpMethod, 
        protected array $httpParams
    ) {}

    protected function getHttpParam(string $key): string|null {
        return $this->httpParams[$key] ?? null;
    }

    protected function setAttribute(string $key, mixed $value): void {
        $this->pageAttributes[$key] = $value;
    }

    protected function setView(string $view):void {
        $this->view = $view;
    }

    protected function setModel(mixed $model):void {
        $this->model = $model;
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