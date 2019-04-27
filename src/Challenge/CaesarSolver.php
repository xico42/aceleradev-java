<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

use AceleraDev\Caesar\CaesarCipher\CaesarCipherDecoder;

class CaesarSolver implements ChallengeSolver
{
    /**
     * @var CaesarCipherDecoder
     */
    private $decoder;
    /**
     * @var HashFunction
     */
    private $hashFunction;

    public function __construct(
        CaesarCipherDecoder $decoder,
        HashFunction $hashFunction
    ) {
        $this->decoder = $decoder;
        $this->hashFunction = $hashFunction;
    }

    public function solve(Challenge $challenge): Solution
    {
        $decodedText = $this->decoder->decode(
            $challenge->getShift(),
            $challenge->getCipherText()
        );
        $hash = $this->hashFunction->hash($decodedText);
        return new Solution(
            $decodedText,
            $hash
        );
    }
}