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
    private $outputFilename;

    protected function setUp(): void
    {
        $this->token = 'MEU_TOKEN';
        $this->outputFilename = 'test_solved.json';
    }

    protected function tearDown(): void
    {
        if (file_exists($this->outputFilename)) {
            unlink($this->outputFilename);
        }
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
            'challenge' => 'challenge.json',
        ]);
        $output = new NullOutput();

        $exitCode = $application->run($input, $output);

        $httpClient->challengeWasSubmitted();
        $submittedChallenge = $httpClient->submittedChallenge();

        $this->assertSame(0, $exitCode);
        $this->assertJsonStringEqualsJsonString(
            file_get_contents(__DIR__ . '/solved_challenge.json'),
            $submittedChallenge
        );
    }
}