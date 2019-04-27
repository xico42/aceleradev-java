<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Acceptance;

use AceleraDev\Caesar\Application;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class SolveChallengeTest extends TestCase
{
    /**
     * @var string
     */
    private $token;

    protected function setUp(): void
    {
        $this->token = 'MEU_TOKEN';
    }

    /**
     * @test
     */
    public function it_should_submit_the_solved_challenge()
    {
        $httpClient = new FakeClient($this->token);
        $application = new Application($httpClient, $this->token);

        $input = new ArrayInput([
            'command' => 'solve-challenge',
            'challenge' => __DIR__ . '/challenge.json',
        ]);
        $output = new NullOutput();

        $exitCode = $application->run($input, $output);

        $httpClient->challengeWasSubmitted();

        $this->assertSame(0, $exitCode);
        $this->assertJsonStringEqualsJsonString(
            file_get_contents(__DIR__ . '/solved_challenge.json'),
            $httpClient->submittedChallenge()
        );
    }
}