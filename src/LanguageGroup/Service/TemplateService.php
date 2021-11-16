<?php declare(strict_types=1);

namespace LanguageGroup\Service;

use LanguageGroup\Exception\FileNotFoundException;

/**
 * Class TemplateService
 * @package LanguageGroup\Service
 */
class TemplateService implements TemplateServiceInterface
{
    /**
     * @param string $file
     * @param array $data
     * @throws FileNotFoundException
     */
    public function render(string $file, array $data): void
    {
        $file = $file . '.php';

        if (!file_exists($file)) {
            throw new FileNotFoundException(
                sprintf('Template file [%s] is missing.', $file)
            );
        }

        extract($data, EXTR_PREFIX_SAME, 'data');

        require($file);
    }
}
