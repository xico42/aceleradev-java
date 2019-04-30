<?php

declare(strict_types=1);

namespace AceleraDev\Caesar;

use AceleraDev\Caesar\CaesarCipher\Alphabet;
use AceleraDev\Caesar\CaesarCipher\CaesarCipherDecoder;
use AceleraDev\Caesar\Challenge\CaesarSolver;
use AceleraDev\Caesar\Challenge\FilesystemChallengeLoader;
use AceleraDev\Caesar\Challenge\HttpSubmission;
use AceleraDev\Caesar\Challenge\Sha1;
use AceleraDev\Caesar\Command\DownloadChallengeCommand;
use AceleraDev\Caesar\Command\SolveChallengeCommand;
use Symfony\Component\Console\Application as ConsoleApplication;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Application
{
    private HttpClient $httpClient;
    private string $token;

    public function __construct(HttpClient $httpClient, string $token)
    {
        $this->httpClient = $httpClient;
        $this->token = $token;
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $alphabet = new Alphabet('abcdefghijklmnopqrstuvwxyz');

        $app = new ConsoleApplication();
        $app->add(new DownloadChallengeCommand($this->httpClient, $this->token));
        $app->add(new SolveChallengeCommand(
            new FilesystemChallengeLoader(),
            new CaesarSolver(
                new CaesarCipherDecoder($alphabet),
                new Sha1()
            ),
            new HttpSubmission($this->httpClient, $this->token)
        ));
        $app->setAutoExit(false);
        return $app->run($input, $output);
    }
}