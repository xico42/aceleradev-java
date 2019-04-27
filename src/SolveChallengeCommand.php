<?php

declare(strict_types=1);

namespace AceleraDev\Caesar;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SolveChallengeCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('solve-challenge')
            ->addArgument(
                'challenge',
                InputArgument::REQUIRED,
                'The json challenge to solve'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return 0;
    }
}