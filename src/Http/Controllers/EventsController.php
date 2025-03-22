<?php

namespace App\Http\Controllers;

use App\Exceptions\ListEventsException;
use App\Http\Request\Handler;
use App\Services\ApiServices;
use App\Template\Engine;
use GuzzleHttp\Exception\GuzzleException;

class EventsController
{
    private Handler $requestHandler;

    public function __construct()
    {
        $this->requestHandler = new Handler();
    }

    public function index(): void
    {
        $service = new ApiServices();
        try {
            $data = $service->listEvents();
        } catch (ListEventsException|GuzzleException $exception) {
            $data = ['items' => []];
            $error = $exception->getMessage();
        }

        Engine::view(
            'events/index',
            [
                'data' => $data,
                'error' => $error ?? null
            ]
        );
    }

    public function create(): void
    {
        Engine::view('events/create');
    }
    
    public function store(): void
    {
        $data = $this->requestHandler->post();
    }
    
    public function show($id): void
    {
        echo $id;
    }
}
