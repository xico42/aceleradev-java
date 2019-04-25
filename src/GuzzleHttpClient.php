<?php

declare(strict_types=1);

namespace AceleraDev\Caesar;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class GuzzleHttpClient implements HttpClient
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function request(string $method, string $uri, array $options): ResponseInterface
    {
        return $this->client->request($method, $uri, $options);
    }
}