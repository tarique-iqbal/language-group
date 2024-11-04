<?php declare(strict_types=1);

namespace LanguageGroup\Service;

interface RestCountriesServiceInterface
{
    /**
     * @throws \UnexpectedValueException
     */
    public function searchByCountryFullName(string $countryName): array;

    /**
     * @throws \UnexpectedValueException
     */
    public function searchByLanguageCode(string $languageCode): array;
}
