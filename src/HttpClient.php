<?php

declare(strict_types=1);

namespace AceleraDev\Caesar;

use Psr\Http\Message\ResponseInterface;

interface HttpClient
{
    public function request(string $method, string $uri, array $options): ResponseInterface;
}