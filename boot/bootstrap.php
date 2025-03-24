<?php

use App\Services\ApiServices;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/..')->load();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$apiService = new ApiServices();
try {
    $apiService->authenticate();
} catch (GuzzleHttp\Exception\GuzzleException|Exception $exception) {
    http_response_code(500);
    echo $exception->getMessage();
    exit;
}


require_once __DIR__ . '/routes.php';

App\Utils\MessageBag::getInstance()->clear();