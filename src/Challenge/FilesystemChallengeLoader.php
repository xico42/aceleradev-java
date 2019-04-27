<?php

declare(strict_types=1);

namespace AceleraDev\Caesar\Challenge;

class FilesystemChallengeLoader implements ChallengeLoader
{
    public function load(string $path): Challenge
    {
        if (! file_exists($path)) {
            throw new ChallengeNotFound($path);
        }

        $json = file_get_contents($path);
        $decoded = json_decode($json, true);

        return new Challenge(
            $decoded['numero_casas'] ?? null,
            $decoded['token'] ?? null,
            $decoded['cifrado'] ?? null
        );
    }
}