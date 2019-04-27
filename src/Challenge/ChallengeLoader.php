<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

interface ChallengeLoader
{
    /**
     * Loads a json file into a challenge
     *
     * @param string $path
     * @return Challenge
     *
     * @throws ChallengeNotFound when the challenge file does not exist
     */
    public function load(string $path): Challenge;
}