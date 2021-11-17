<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Interface ConfigServiceInterface
 * @package LanguageGroup\Service
 */
interface ConfigServiceInterface
{
    /**
     * @param string $country
     * @return string
     */
    public function getApiUrlSearchByCountryFullName(string $country): string;

    /**
     * @param string $languageCode
     * @return string
     */
    public function getApiUrlSearchByLanguageCode(string $languageCode): string;

    /**
     * @return string
     */
    public function getErrorLogFile(): string;
}
