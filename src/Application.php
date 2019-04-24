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

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function run(InputInterface $input, OutputInterface $output): int
    {
        $app = new \Symfony\Component\Console\Application();
        $app->add(new DownloadChallengeCommand($this->httpClient));
        $app->setAutoExit(false);
        return $app->run($input, $output);
    }
}