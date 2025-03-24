<?php

namespace App\Utils;

class Old
{
    private static ?Old $instance = null;

    public function __construct()
    {
        if (!isset($_SESSION['old'])) {
            $_SESSION['old'] = [];
        }
    }

    public static function getInstance(): Old
    {
        if (!self::$instance) {
            self::$instance = new Old();
        }

        return self::$instance;
    }

    public function add($key, $data): void
    {
        $_SESSION['old'][$key] = $data;
    }

    public function get($key): mixed
    {
        return $_SESSION['old'][$key] ?? null;
    }

    public function clear(): void
    {
        $_SESSION['old'] = [];
    }
}