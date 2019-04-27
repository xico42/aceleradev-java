<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Command;

use AceleraDev\Caesar\Challenge\ChallengeLoader;
use AceleraDev\Caesar\Challenge\ChallengeSolver;
use AceleraDev\Caesar\Challenge\ChallengeSubmission;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SolveChallengeCommand extends Command
{
    /**
     * @var ChallengeLoader
     */
    private $loader;
    /**
     * @var ChallengeSubmission
     */
    private $submission;
    /**
     * @var ChallengeSolver
     */
    private $solver;

    public function __construct(
        ChallengeLoader $loader,
        ChallengeSolver $solver,
        ChallengeSubmission $submission
    ) {
        parent::__construct('solve-challenge');
        $this->loader = $loader;
        $this->submission = $submission;
        $this->solver = $solver;
    }

    protected function configure()
    {
        $this
            ->addArgument(
                'challenge',
                InputArgument::REQUIRED,
                'The json challenge to solve'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('challenge');
        $challenge = $this->loader->load($file);
        $solution = $this->solver->solve($challenge);
        $challenge->solve($solution);
        $this->submission->submit($challenge);
    }
}