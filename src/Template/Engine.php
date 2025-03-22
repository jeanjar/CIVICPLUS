<?php

namespace App\Template;

class Engine
{
    public static function view(string $view, array $data = []): void
    {
        ob_start();
        extract($data);
        require_once __DIR__ . '/../../resources/views/' . $view . '.php';
        self::renderLayout('layout', ob_get_clean());
    }

    public static function renderLayout(string $layout, string $content, ?string $scripts = null): void
    {
        require_once __DIR__ . '/../../resources/views/template/' . $layout . '.php';
    }

    public static function alert(string $message, string $type = 'info'): string
    {
        return '<div class="alert alert-' . $type . '">' . $message . '</div>';
    }
}
