<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

class Solution
{
    private string $decodedText;
    private string $hashCode;

    public function __construct(
        string $decodedText,
        string $hashCode
    ) {
        $this->decodedText = $decodedText;
        $this->hashCode = $hashCode;
    }

    public function getDecodedText(): string
    {
        return $this->decodedText;
    }

    public function getHashCode(): string
    {
        return $this->hashCode;
    }
}