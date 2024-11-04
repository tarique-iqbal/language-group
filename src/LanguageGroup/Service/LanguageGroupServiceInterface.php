<?php declare(strict_types=1);

namespace LanguageGroup\Service;

interface LanguageGroupServiceInterface
{
    public function getResultForCountry(string $countryName): array;
}
