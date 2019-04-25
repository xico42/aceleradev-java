<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Acceptance;

use AceleraDev\Caesar\HttpClient;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Stream;
use function GuzzleHttp\Psr7\stream_for;
use PHPUnit\Framework\Assert;
use Psr\Http\Message\ResponseInterface;

class FakeClient implements HttpClient
{
    private $loggedRequests = [];
    private $token;

    /**
     * FakeClient constructor.
     * @param $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function request(string $method, string $uri, array $options): ResponseInterface
    {
        $this->loggedRequests[] = compact('method', 'uri', 'options');

        $response = new Response();
        $query = $options['query'] ?? [];
        $token = $query['token'] ?? null;
        if ($token !== $this->token) {
            return $response
                ->withBody(stream_for('{}'))
                ->withStatus(404);
        }

        if (
            'challenge/dev-ps/generate-data' === $uri
            && 'GET' === $method
        ) {
            return $this->generateData($response);
        }

        return $response->withStatus(404);
    }

    public function challengeWasRequested()
    {
        $expectedRequest = [
            'method' => 'GET',
            'uri' => 'challenge/dev-ps/generate-data',
            'options' => [
                'query' => [
                    'token' => $this->token
                ]
            ]
        ];

        Assert::assertContains($expectedRequest, $this->loggedRequests);
    }

    private function generateData(ResponseInterface $response): ResponseInterface
    {
        $body = json_encode([
            'numero_casas' => 7,
            'token' => $this->token,
            'cifrado' => 'zptwspjpaf pz wylylxbpzpal mvy ylsphipspaf. lkznly d. kpqrzayh',
            'decifrado' => '',
            'resumo_criptografico' => ''
        ]);
        return $response
            ->withBody(stream_for($body));
    }
}