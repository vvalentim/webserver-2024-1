<?php

namespace Core;

abstract class Controller {
    protected $view;

    protected $model;

    protected $httpMethod;

    protected $httpParams;
    
    protected $pageAttributes = [];

    public abstract function view();
    
    public function __construct($httpMethod, $httpParams) {
        $this->httpMethod = $httpMethod;
        $this->httpParams = $httpParams;
    }

    protected function getHttpParam(string $key): string|null {
        return $this->httpParams[$key] ?? null;
    }

    protected function setAttribute(string $key, string $value): void {
        $this->pageAttributes[$key] = $value;
    }

    protected function setAttributes($key, $value): void {
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

    protected function jsonResponse($error, $message = 'Criado com sucesso'){
        header('Content-Type: application/json');
        if($error) http_response_code(500);
        $response = array('error' => $error, 'message' => $message);
        return json_encode($response);
    }
}