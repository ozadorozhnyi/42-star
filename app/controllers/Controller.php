<?php

declare(strict_types=1);

abstract class Controller
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    protected function render(string $page, array $data = []): void
    {
        extract($data);

        require_once VIEWS_PATH . '/main.php';
    }
}