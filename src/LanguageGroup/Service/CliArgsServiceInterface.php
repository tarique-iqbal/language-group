<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Interface CLIArgsServiceInterface
 * @package LanguageGroup\Service
 */
interface CliArgsServiceInterface
{
    /**
     * @return array
     */
    public function getArgs(): array;
}
