<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\CaesarCipher;

class CaesarCipherDecoder
{
    private Alphabet $alphabet;

    public function __construct(Alphabet $alphabet)
    {
        $this->alphabet = $alphabet;
    }

    public function decode(int $shift, string $ciphertext): string
    {
        $decoded = '';
        $chars = str_split(
            strtolower($ciphertext)
        );
        foreach ($chars as $char) {
            $decoded .= $this->alphabet->shiftedChar($char, -$shift);
        }
        return $decoded;
    }
}