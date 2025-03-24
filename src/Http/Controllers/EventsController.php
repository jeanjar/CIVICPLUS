<?php

namespace App\Http\Controllers;

use App\DTO\CreateEventDTO;
use App\Exceptions\CreateEventsException;
use App\Exceptions\ListEventsException;
use App\Http\Request\Handler;
use App\Services\ApiServices;
use App\Template\Engine;
use App\URL\Builder;
use App\Utils\MessageBag;
use GuzzleHttp\Exception\GuzzleException;

class EventsController
{
    private Handler $requestHandler;

    public function __construct()
    {
        $this->requestHandler = new Handler();
    }

    public function index(): string
    {
        $service = new ApiServices();
        try {
            $data = $service->listEvents();
        } catch (ListEventsException|GuzzleException $exception) {
            $data = ['items' => []];
            MessageBag::getInstance()->add('error', 'error', $exception->getMessage());
        }

        return Engine::view('events/index', ['data' => $data]);
    }

    public function create(): string
    {
        return Engine::view('events/create');
    }

    public function store(): void
    {
        $data = new CreateEventDTO(...$this->requestHandler->post());
        $data->validate();

        if ($data->hasErrors()) {
            foreach ($data->errors as $error) {
                MessageBag::getInstance()->add('danger', 'error', $error);
            }

            Builder::redirect('events/create');
        }

        try {
            $service = new ApiServices();
            $service->createEvent($data);
            MessageBag::getInstance()->add('success', 'success', 'Event created');
            Builder::redirect('events');
        } catch (CreateEventsException|GuzzleException $e) {
            MessageBag::getInstance()->add('danger', 'error', $e->getMessage());
            Builder::redirect('events/create');
        }
    }

    public function show($id): mixed
    {
        return $id;
    }
}
