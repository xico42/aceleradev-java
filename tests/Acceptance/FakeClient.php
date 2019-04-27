<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Acceptance;

use AceleraDev\Caesar\HttpClient;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\Assert;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\stream_for;

class FakeClient implements HttpClient
{
    private $token;
    private $challengeWasRequested = false;
    /**
     * @var bool
     */
    private $challengeWasSubmitted = false;
    private $submittedChallenge = '';

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
            $this->challengeWasRequested = true;
            return $this->generateData($response);
        }

        if (
            'challenge/dev-ps/submit-solution' === $uri
            && 'POST' === $method
        ) {
            return $this->submitSolution($options, $response);
        }

        return $response->withStatus(404);
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

    public function challengeWasRequested()
    {
        Assert::assertTrue(
            $this->challengeWasRequested,
            'The challenged should have been requested'
        );
    }

    public function challengeWasSubmitted()
    {
        Assert::assertTrue(
            $this->challengeWasSubmitted,
            'The challenge should have been submitted'
        );
    }

    public function submittedChallenge()
    {
        return $this->submittedChallenge;
    }

    private function submitSolution(array $options, ResponseInterface $response): ResponseInterface
    {
        $multipart = $options['multipart'] ?? [];
        if (1 !== count($multipart)) {
            return $response->withStatus(404);
        }

        $multipartElement = array_pop($multipart);
        $multipartElement['name'] = $multipartElement['name'] ?? '';
        $multipartElement['filename'] = $multipartElement['filename'] ?? '';

        if (
            $multipartElement['name'] !== 'answer'
            || !isset($multipartElement['contents'])
            || $multipartElement['filename'] !== 'answer.json'
        ) {
            return $response->withStatus(200);
        }

        $this->challengeWasSubmitted = true;
        $this->submittedChallenge = $multipartElement['contents'];
        return $response->withStatus(200);
    }
}