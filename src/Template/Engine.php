<?php

namespace App\Template;

class Engine
{
    public static function view(string $view, array $data = []): string
    {
        ob_start();
        extract($data);
        require_once __DIR__ . '/../../resources/views/' . $view . '.php';
        return self::renderLayout('layout', ob_get_clean());
    }

    public static function renderLayout(string $layout, string $content, ?string $scripts = null): string
    {
        ob_start();
        require_once __DIR__ . '/../../resources/views/template/' . $layout . '.php';
        return ob_get_clean();
    }

    public static function alert(string $message, string $type = 'info'): string
    {
        return '<div class="alert alert-' . $type . '">' . $message . '</div>';
    }
    
    public static function pagination($total, $limit, $page, $url, $pageQueryName = 'page'): string
    {
        $pages = ceil($total / $limit);
        $html = '<nav><ul class="pagination">';
        $html .= '<li class="page-item"><a class="page-link" href="' . $url . '?' . $pageQueryName .'=1">First</a></li>';
        for ($i = 1; $i <= $pages; $i++) {
            $html .= '<li class="page-item"><a class="page-link" href="' . $url . '?' . $pageQueryName . '=' . $i . '">' . $i . '</a></li>';
        }
        $html .= '<li class="page-item"><a class="page-link" href="' . $url . '?' . $pageQueryName . '=' .$pages . '">Last</a></li>';
        $html .= '</ul></nav>';
        return $html;
    }
}
