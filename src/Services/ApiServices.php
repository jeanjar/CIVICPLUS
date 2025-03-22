<?php

namespace App\Services;

use App\Exceptions\ListEventsException;
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
            var_dump($exception);
            die('Unable to authenticate');
        }
    }

    /**
     * @return array
     * @throws ListEventsException|GuzzleException
     */
    public function listEvents(): array
    {
        $response = $this->client->request('get', 'api/Events', [
            'headers' => [
                'Authorization' => 'Bearer ' . $_SESSION['token']
            ]
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new ListEventsException($response->getReasonPhrase());
        }

        return json_decode($response->getBody()->getContents(), true);
    }
}