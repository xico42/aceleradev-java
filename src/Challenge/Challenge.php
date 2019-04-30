<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

use JsonSerializable;

class Challenge implements JsonSerializable
{
    private int $shift;
    private string $token;
    private string $cipherText;
    private string $decodedText = '';
    private string $hash = '';

    public function __construct(
        int $shift,
        string $token,
        string $cipherText
    ) {
        $this->shift = $shift;
        $this->token = $token;
        $this->cipherText = $cipherText;
    }

    public function solve(Solution $solution)
    {
        $this->decodedText = $solution->getDecodedText();
        $this->hash = $solution->getHashCode();
    }

    public function getShift(): int
    {
        return $this->shift;
    }

    public function getCipherText(): string
    {
        return $this->cipherText;
    }

    public function jsonSerialize()
    {
        return [
            'numero_casas' => $this->shift,
            'token' => $this->token,
            'cifrado' => $this->cipherText,
            'decifrado' => $this->decodedText,
            'resumo_criptografico' => $this->hash
        ];
    }
}