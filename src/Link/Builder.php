<?php

namespace App\Link;

class Builder
{
    public static function absolute(string $url, ?array $query = null): string
    {
        return ($_SERVER['REQUEST_SCHEME'] ?? 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $url . (empty($query) ? '' : '?' . http_build_query($query));
    }
}