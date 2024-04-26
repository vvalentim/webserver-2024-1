<?php

namespace Core;

abstract class Controller {
    protected $pageAttributes = [];

    public abstract function view();

    protected function setAttribute(string $key, mixed $value): void {
        $this->pageAttributes[$key] = $value;
    }

    protected function setAttributes(array $attributes): void {
        foreach($attributes as $key => $value) {
            $this->pageAttributes[$key] = $value;
        }
    }

    protected function render(string $viewPath): void {
        extract($this->pageAttributes);

        require($viewPath);

        exit();
    }
}