<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Unit;

use AceleraDev\Caesar\Alphabet;
use AceleraDev\Caesar\CaesarCipherDecoder;
use PHPUnit\Framework\TestCase;

class CaesarCipherDecoderTest extends TestCase
{
    /**
     * @var CaesarCipherDecoder
     */
    private $decoder;

    protected function setUp(): void
    {
        $this->decoder = new CaesarCipherDecoder(
            new Alphabet('abcdefghijklmnopqrstuvwxyz')
        );
    }

    /**
     * @test
     */
    public function it_decodes_a_char()
    {
        $this->assertEquals(
            'a',
            $this->decoder->decode(3, 'd')
        );
    }

    /**
     * @test
     */
    public function it_decodes_a_word()
    {
        $this->assertEquals(
            'ligeira',
            $this->decoder->decode(3, 'oljhlud')
        );
    }

    /**
     * @test
     */
    public function it_ignores_non_alphabet_chars()
    {
        $this->assertEquals(
            '1a.a',
            $this->decoder->decode(3, '1d.d')
        );
    }

    /**
     * @test
     */
    public function it_decodes_full_text()
    {
        $ciphertext = 'd oljhlud udsrvd pduurp vdowrx vreuh r fdfkruur fdqvdgr';
        $this->assertEquals(
            'a ligeira raposa marrom saltou sobre o cachorro cansado',
            $this->decoder->decode(3, $ciphertext)
        );
    }

    /**
     * @test
     */
    public function it_converts_to_lower_case()
    {
        $this->assertEquals(
            'a',
            $this->decoder->decode(3, 'D')
        );
    }

    /**
     * @test
     */
    public function it_decodes_the_first_char_of_the_alphabet()
    {
        $this->assertEquals(
            'z',
            $this->decoder->decode(1, 'a')
        );
    }
}