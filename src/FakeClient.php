<?php

declare(strict_types=1);

namespace AceleraDev\Caesar;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class FakeClient implements HttpClient
{
    public function request(string $method, string $uri, array $options): ResponseInterface
    {
        return new Response();
    }
}