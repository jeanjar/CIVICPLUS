<?php

namespace App\URL;

class Builder
{
    public static function absolute(string $url, ?array $query = null): string
    {
        return ($_SERVER['REQUEST_SCHEME'] ?? 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $url . (empty($query) ? '' : '?' . http_build_query($query));
    }
    
    public static function redirect($to): never
    {
        $url = self::absolute($to);
        header("Location: {$url}");
        die;
    }
}