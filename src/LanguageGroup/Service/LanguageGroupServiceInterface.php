<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Interface LanguageGroupServiceInterface
 * @package LanguageGroup\Service
 */
interface LanguageGroupServiceInterface
{
    /**
     * @param string $countryName
     * @return array
     */
    public function getResultForCountry(string $countryName): array;
}
