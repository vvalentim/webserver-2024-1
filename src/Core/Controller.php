<?php

namespace Core;

use InvalidArgumentException;

abstract class Controller {
    public function __construct(
        protected array $attributes = []
    ) {}

    protected function setAttribute(string $key, mixed $value): Controller {
        $this->attributes[$key] = $value;

        return $this;
    }

    protected function render(string $view, int $code = 200, ?string $path = null): void {
        if (
            !isset($this->attributes["title"]) ||
            !isset($this->attributes["page_layout_css"])
        ) {
            throw new InvalidArgumentException("Attributes 'title' and 'page_layout_css' must be set to render a view.");
        }

        extract($this->attributes);

        http_response_code($code);

        if ($path) {
            require("{$path}/{$view}.view.php");
        } else {
            $viewPath = str_replace("Controllers\\", "", static::class);
            $viewPath = str_replace("\\", "/", $viewPath);
            $viewPath = strtolower($viewPath);

            require(Helpers::getPath("views")."/{$viewPath}/{$view}.view.php");
        }

        exit();
    }
}