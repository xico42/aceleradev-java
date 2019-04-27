<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Unit\CaesarCipher;

use AceleraDev\Caesar\CaesarCipher\Alphabet;
use PHPUnit\Framework\TestCase;

class AlphabetTest extends TestCase
{
    /**
     * @var \AceleraDev\Caesar\CaesarCipher\Alphabet
     */
    private $alphabet;

    protected function setUp(): void
    {
        $this->alphabet = new Alphabet(
            'abcdefghijklmnopqrstuvwxyz'
        );
    }

    /**
     * @test
     */
    public function it_shifts_a_char_by_a_positive_number()
    {
        $this->assertEquals(
            'c',
            $this->alphabet->shiftedChar('a', 2)
        );
    }

    /**
     * @test
     */
    public function it_shifts_a_char_by_a_negative_number()
    {
        $this->assertEquals(
            'l',
            $this->alphabet->shiftedChar('o', -3)
        );
    }

    /**
     * @test
     */
    public function it_returns_the_char_when_the_char_does_not_exist_in_the_alphabet()
    {
        $this->assertEquals(
            'ç',
            $this->alphabet->shiftedChar('ç', 8)
        );
    }

    /**
     * @test
     */
    public function it_shifts_a_char_by_a_positive_number_with_module_higher_than_the_alphabet_size()
    {
        $this->assertEquals(
            'j',
            $this->alphabet->shiftedChar('e', 31)
        );
    }

    /**
     * @test
     */
    public function it_shifts_a_char_by_a_negative_number_with_module_higher_than_the_alphabet_size()
    {
        $this->assertEquals(
            'e',
            $this->alphabet->shiftedChar('m', -190)
        );
    }

    /**
     * @test
     */
    public function it_shifts_the_first_char_by_a_negative_number()
    {
        $this->assertEquals(
            'z',
            $this->alphabet->shiftedChar('a', -1)
        );
    }
}