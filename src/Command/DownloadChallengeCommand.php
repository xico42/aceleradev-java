<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Command;

use AceleraDev\Caesar\HttpClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadChallengeCommand extends Command
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
        parent::__construct('download-challenge');
        $this->httpClient = $httpClient;
        $this->token = $token;
    }

    protected function configure()
    {
        $this
            ->setDescription('Requests the challenge in the codenation api')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'The file to save the challenge',
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        $challenge = $this->httpClient->request('GET', 'challenge/dev-ps/generate-data', [
            'query' => ['token' => $this->token]
        ]);
        file_put_contents($file, $challenge->getBody()->getContents());
    }
}