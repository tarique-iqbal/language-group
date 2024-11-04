<?php declare(strict_types=1);

namespace LanguageGroup\Service;

final class CliArgsService implements CliArgsServiceInterface
{
    public function getArgs(): array
    {
        $argv = $_SERVER['argv'];
        array_shift($argv);

        return $argv;
    }
}
