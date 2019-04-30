<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\CaesarCipher;

class Alphabet
{
    private array $alphabetChars;

    public function __construct(string $alphabetChars)
    {
        $this->alphabetChars = str_split($alphabetChars);
    }

    public function shiftedChar(string $char, int $shift): string
    {
        $index = array_search($char, $this->alphabetChars);
        if (false === $index) {
            return $char;
        }
        return $this->findChar($index, $shift);
    }

    private function findChar(int $index, int $shift): string
    {
        $normalizedIndex = $this->normalizeIndex($index + $shift);
        return $this->alphabetChars[$normalizedIndex];
    }

    private function normalizeIndex(int $index): int
    {
        $alphabetSize = count($this->alphabetChars);
        $newIndex = $index % $alphabetSize;
        if ($newIndex < 0) {
            return $newIndex + $alphabetSize;
        }
        return $newIndex;
    }
}