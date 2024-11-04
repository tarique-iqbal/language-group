<?php declare(strict_types=1);

namespace LanguageGroup\Entity;

class LanguageGroup
{
    private string $languageCode;

    private array $countries = [];

    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }

    public function getCountries(): array
    {
        return $this->countries;
    }

    public function setCountries(array $countries): void
    {
        $this->countries = $countries;
    }
}
