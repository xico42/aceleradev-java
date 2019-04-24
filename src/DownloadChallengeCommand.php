<?php

declare(strict_types=1);

namespace AceleraDev\Caesar;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DownloadChallengeCommand extends Command
{
    public function __construct(HttpClient $httpClient)
    {
        parent::__construct('download-challenge');
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
        $contents = <<<JSON
{
  "numero_casas":7,
  "token":"42887b08841c9cc5df017965ca9aca0d134259c6",
  "cifrado":"zptwspjpaf pz wylylxbpzpal mvy ylsphipspaf. lkznly d. kpqrzayh",
  "decifrado":"",
  "resumo_criptografico":""
}
JSON;
        file_put_contents($file, $contents);
    }
}