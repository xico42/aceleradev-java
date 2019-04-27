<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Unit\Challenge;

use AceleraDev\Caesar\Challenge\Challenge;
use AceleraDev\Caesar\Challenge\Solution;
use PHPUnit\Framework\TestCase;

class ChallengeTest extends TestCase
{
    /**
     * @test
     */
    public function it_serializes()
    {
        $challenge = new Challenge(
            9,
            'MEU_TOKEN',
            'cipher'
        );

        $solution = new Solution(
            'decoded',
            'hash'
        );

        $challenge->solve($solution);

        $this->assertEquals([
            'numero_casas' => 9,
            'token' => 'MEU_TOKEN',
            'cifrado' => 'cipher',
            'decifrado' => 'decoded',
            'resumo_criptografico' => 'hash'
        ], $challenge->jsonSerialize());
    }
}