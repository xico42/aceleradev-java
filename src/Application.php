<?php

declare(strict_types=1);

namespace AceleraDev\Caesar;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Application
{
    /**
     * @var HttpClient
     */
    private $httpClient;
    /**
     * @var string
     */
    private $token;

    public function __construct(HttpClient $httpClient, string $token)
    {
        $this->httpClient = $httpClient;
        $this->token = $token;
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $app = new \Symfony\Component\Console\Application();
        $app->add(new DownloadChallengeCommand($this->httpClient, $this->token));
        $app->add(new SolveChallengeCommand());
        $app->setAutoExit(false);
        return $app->run($input, $output);
    }
}