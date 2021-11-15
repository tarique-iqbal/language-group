<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Interface RestCountriesServiceInterface
 * @package LanguageGroup\Service
 */
interface RestCountriesServiceInterface
{
    /**
     * @param string $countryName
     * @return array
     * @throws \UnexpectedValueException
     */
    public function searchByCountryFullName(string $countryName): array;

    /**
     * @param string $languageCode
     * @return array
     * @throws \UnexpectedValueException
     */
    public function searchByLanguageCode(string $languageCode): array;
}
