<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

class Solution
{
    /**
     * @var string
     */
    private $decodedText;
    /**
     * @var string
     */
    private $hashCode;

    public function __construct(
        string $decodedText,
        string $hashCode
    ) {
        $this->decodedText = $decodedText;
        $this->hashCode = $hashCode;
    }

    /**
     * @return string
     */
    public function getDecodedText(): string
    {
        return $this->decodedText;
    }

    /**
     * @return string
     */
    public function getHashCode(): string
    {
        return $this->hashCode;
    }
}