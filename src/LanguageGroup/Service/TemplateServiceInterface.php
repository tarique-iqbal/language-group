<?php declare(strict_types=1);

namespace LanguageGroup\Service;

use LanguageGroup\Exception\FileNotFoundException;

/**
 * Interface TemplateServiceInterface
 * @package LanguageGroup\Service
 */
interface TemplateServiceInterface
{
    /**
     * @param string $file
     * @param array $data
     * @throws FileNotFoundException
     */
    public function render(string $file, array $data): void;
}
