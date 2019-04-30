<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

use AceleraDev\Caesar\HttpClient;

class HttpSubmission implements ChallengeSubmission
{
    private HttpClient $httpClient;
    private string $token;

    public function __construct(HttpClient $httpClient, string $token)
    {
        $this->httpClient = $httpClient;
        $this->token = $token;
    }

    public function submit(Challenge $challenge)
    {
        $this->httpClient->request(
            'POST',
            'challenge/dev-ps/submit-solution',
            [
                'query' => ['token' => $this->token],
                'multipart' => [
                    [
                        'name' => 'answer',
                        'filename' => 'answer.json',
                        'contents' => json_encode($challenge)
                    ]
                ]
            ]
        );
    }
}