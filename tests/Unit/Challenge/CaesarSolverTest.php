<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Unit\Challenge;

use AceleraDev\Caesar\CaesarCipher\CaesarCipherDecoder;
use AceleraDev\Caesar\Challenge\CaesarSolver;
use AceleraDev\Caesar\Challenge\Challenge;
use AceleraDev\Caesar\Challenge\HashFunction;
use AceleraDev\Caesar\Challenge\Solution;
use PHPUnit\Framework\TestCase;

class CaesarSolverTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_decode_and_hash_the_decoded_text()
    {
        $hashFunction = $this->prophesize(HashFunction::class);
        $decoder = $this->prophesize(CaesarCipherDecoder::class);

        $challenge = new Challenge(
            9,
            'MEU_TOKEN',
            'snbdb'
        );

        $decoder->decode($challenge->getShift(), $challenge->getCipherText())
            ->willReturn('decoded text');
        $hashFunction->hash('decoded text')
            ->willReturn('hashed text');

        $expectedSolution = new Solution(
            'decoded text',
            'hashed text'
        );

        $solver = new CaesarSolver(
            $decoder->reveal(),
            $hashFunction->reveal()
        );

        $solution = $solver->solve($challenge);

        $this->assertEquals($expectedSolution, $solution);
    }
}