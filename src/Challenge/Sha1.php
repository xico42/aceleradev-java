<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

class Sha1 implements HashFunction
{
    public function hash(string $text): string
    {
        return sha1($text);
    }
}