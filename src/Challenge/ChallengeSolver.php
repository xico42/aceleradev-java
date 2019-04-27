<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

interface ChallengeSolver
{
    public function solve(Challenge $challenge): Solution;
}