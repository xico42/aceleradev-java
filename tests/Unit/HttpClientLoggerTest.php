<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Unit;

use AceleraDev\Caesar\HttpClient;
use AceleraDev\Caesar\HttpClientLogger;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Output\Output;
use Psr\Http\Message\ResponseInterface;

class HttpClientLoggerTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_output_the_response()
    {
        $httpClient = $this->makeClient();
        $output = $this->makeOutput();
        $logger = new HttpClientLogger($httpClient, $output);
        $logger->request('GET', 'call/uri', []);

        $this->assertStringContainsString(
            'sample response',
            $output->getContents()
        );
    }

    /**
     * @test
     */
    public function it_should_log_the_request()
    {
        $httpClient = $this->makeClient();
        $output = $this->makeOutput();
        $logger = new HttpClientLogger($httpClient, $output);
        $logger->request('GET', 'call/uri', []);

        $this->assertStringContainsString(
            'GET call/uri',
            $output->getContents()
        );
    }

    private function makeOutput()
    {
        return new class extends Output {
            public $output = '';

            public function getContents()
            {
                return $this->output;
            }

            protected function doWrite($message, $newline)
            {
                $this->output .= $message.($newline ? "\n" : '');
            }
        };
    }

    /**
     * @return HttpClient
     */
    private function makeClient()
    {
        $httpClient = new class implements HttpClient
        {
            public function request(string $method, string $uri, array $options): ResponseInterface
            {
                $response = new Response();
                return $response->withBody(stream_for('sample response'));
            }
        };
        return $httpClient;
    }
}