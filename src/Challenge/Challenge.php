<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

use JsonSerializable;

class Challenge implements JsonSerializable
{
    /**
     * @var int
     */
    private $shift;
    /**
     * @var string
     */
    private $token;
    /**
     * @var string
     */
    private $cipherText;
    /**
     * @var string
     */
    private $decodedText = '';
    /**
     * @var string
     */
    private $hash = '';

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

    /**
     * @return int
     */
    public function getShift(): int
    {
        return $this->shift;
    }

    /**
     * @return string
     */
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