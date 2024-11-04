<?php declare(strict_types=1);

namespace LanguageGroup\Service;

interface ConfigServiceInterface
{
    public function getApiUrlSearchByCountryFullName(string $country): string;

    public function getApiUrlSearchByLanguageCode(string $languageCode): string;

    public function getErrorLogFile(): string;
}
