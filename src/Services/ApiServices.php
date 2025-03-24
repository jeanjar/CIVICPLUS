<?php

namespace App\Services;

use App\DTO\CreateEventDTO;
use App\Exceptions\CreateEventsException;
use App\Exceptions\EventNotFoundException;
use App\Exceptions\ListEventsException;
use App\Exceptions\UnableToAuthenticateException;
use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class ApiServices
{
    public Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => "{$_ENV['API_URL']}/{$_ENV['REQUEST_PREFIX']}/",
        ]);
    }

    /**
     * @return void
     * @throws GuzzleException
     * @throws UnableToAuthenticateException
     */
    public function authenticate(): void
    {
        if (isset($_SESSION['token'])) {
            return;
        }

        try {
            $response = $this->client->request(
                'post',
                'api/Auth',
                [
                    'json' => [
                        'clientId' => $_ENV['CLIENT_ID'],
                        'clientSecret' => $_ENV['CLIENT_SECRET'],
                    ],
                ]
            );

            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody()->getContents(), true);
                $_SESSION['token'] = $data['access_token'];
            }
        } catch (Exception $exception) {
            error_log($exception->getMessage());
            throw new UnableToAuthenticateException($exception->getMessage());
        }
    }

    /**
     * @return array
     * @throws ListEventsException|GuzzleException
     */
    public function listEvents($limit = 5, $offset = 0, ?string $filter = null): array
    {
        $query = [
            '$top' => $limit,
            '$skip' => $offset <= 1 ? 0 : ($offset - 1) * $limit,
        ];

        if ($filter) {
            $query['$filter'] = $filter;
        }

        $response = $this->client->request('get', 'api/Events', [
            'headers' => [
                'Authorization' => 'Bearer ' . $_SESSION['token']
            ],
            'query' => $query,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new ListEventsException($response->getReasonPhrase());
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param CreateEventDTO $createEventDTO
     * @return array
     * @throws CreateEventsException
     * @throws GuzzleException
     */
    public function createEvent(CreateEventDTO $createEventDTO): array
    {
        $response = $this->client->request('post', 'api/Events', [
            'headers' => [
                'Authorization' => 'Bearer ' . $_SESSION['token']
            ],
            'json' => [
                ...$createEventDTO->toArray(),
            ],
        ]);

        if ($response->getStatusCode() !== 201) {
            throw new CreateEventsException($response->getReasonPhrase());
        }

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @throws GuzzleException|EventNotFoundException
     */
    public function showEvent($id): array
    {
        try {
            $response = $this->client->request('get', 'api/Events/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $_SESSION['token']
                ],
            ]);

            if ($response->getStatusCode() !== 200) {
                error_log($response->getReasonPhrase());
                throw new EventNotFoundException($id);
            }

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            error_log($e->getMessage());
            throw new EventNotFoundException($id);
        }
    }
}