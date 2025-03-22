<?php

use App\Services\ApiServices;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..')->load();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$apiService = new ApiServices();
$apiService->authenticate();

require_once __DIR__ . '/routes.php';
