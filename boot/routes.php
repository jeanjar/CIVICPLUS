<?php

$router = new App\Http\Router\Router();

$router->get('/', App\Http\Controllers\EventsController::class, 'index');
$router->get('/events', App\Http\Controllers\EventsController::class, 'index');
$router->get('/events/create', App\Http\Controllers\EventsController::class, 'create');
$router->get('/events/{id}', App\Http\Controllers\EventsController::class, 'show');
$router->post('/events', App\Http\Controllers\EventsController::class, 'store');

echo $router->dispatch();