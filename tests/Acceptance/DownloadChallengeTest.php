<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Acceptance;

use AceleraDev\Caesar\Application;
use AceleraDev\Caesar\FakeClient;
use AceleraDev\Caesar\DownloadChallengeCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

class DownloadChallengeTest extends TestCase
{
    private $filename = 'answer_test.json';

    protected function tearDown(): void
    {
        if (file_exists($this->filename)) {
            unlink($this->filename);
        }
    }

    /**
     * @test
     */
    public function it_should_download_and_save_the_challenge()
    {
        $httpClient = new FakeClient();
        $application = new Application($httpClient);

        $input = new ArrayInput([
            'command' => 'download-challenge',
            'file' => $this->filename
        ]);
        $output = new NullOutput();

        $exitCode = $application->run($input, $output);

        $this->assertEquals(0, $exitCode);
        $this->assertFileEquals(__DIR__ . '/challenge.json', $this->filename);
    }
}