<?php

declare(strict_types=1);

namespace AceleraDev\Caesar;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HttpClientLogger implements HttpClient
{
    /**
     * @var HttpClient
     */
    private $httpClient;
    /**
     * @var OutputInterface
     */
    private $output;

    public function __construct(HttpClient $httpClient, OutputInterface $output)
    {
        $this->httpClient = $httpClient;
        $this->output = $output;
    }

    public function request(
        string $method,
        string $uri,
        array $options
    ): ResponseInterface {
        $response = $this->httpClient->request($method, $uri, $options);
        $this->output->writeln([
            $method . ' ' . $uri,
            json_encode($options, JSON_PRETTY_PRINT),
            '-----------',
            'HTTP/1.1 ' . $response->getReasonPhrase() . ' ' . $response->getStatusCode(),
            '',
            $response->getBody()->getContents(),
        ]);
        $response->getBody()->rewind();
        return $response;
    }
}