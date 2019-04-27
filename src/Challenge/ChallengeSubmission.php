<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

interface ChallengeSubmission
{
    public function submit(Challenge $challenge);
}