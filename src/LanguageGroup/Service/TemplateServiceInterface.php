<?php declare(strict_types=1);

namespace LanguageGroup\Service;

use LanguageGroup\Exception\FileNotFoundException;

interface TemplateServiceInterface
{
    /**
     * @throws FileNotFoundException
     */
    public function render(string $file, array $data): void;
}
