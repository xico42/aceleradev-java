<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Tests\Unit\Challenge;

use AceleraDev\Caesar\Challenge\Challenge;
use AceleraDev\Caesar\Challenge\ChallengeNotFound;
use AceleraDev\Caesar\Challenge\FilesystemChallengeLoader;
use PHPUnit\Framework\TestCase;

class FilesystemChallengeLoaderTest extends TestCase
{
    /**
     * @test
     */
    public function it_should_load_the_challenge_from_json_file()
    {
        $path = __DIR__ . '/challenge.json';
        $loader = new FilesystemChallengeLoader();
        $challenge = $loader->load($path);

        $this->assertEquals(
            new Challenge(
                9,
                'MEU_TOKEN',
                'zptwspjpaf pz'
            ),
            $challenge
        );
    }

    /**
     * @test
     * @throws ChallengeNotFound
     */
    public function it_should_throw_exception_when_the_json_file_does_not_exist()
    {
        $this->expectException(ChallengeNotFound::class);
        $path = 'does/not/exist/file.json';
        $loader = new FilesystemChallengeLoader();
        $loader->load($path);
    }
}