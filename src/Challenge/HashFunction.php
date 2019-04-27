<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

interface HashFunction
{
    public function hash(string $text): string;
}