<?php declare(strict_types=1);

namespace LanguageGroup\Entity;

/**
 * Class Language
 * @package LanguageGroup\Entity
 */
class LanguageGroup
{
    /**
     * @var string
     */
    private string $languageCode;

    /**
     * @var array
     */
    private array $countries = [];

    /**
     * @return string
     */
    public function getLanguageCode(): string
    {
        return $this->languageCode;
    }

    /**
     * @param string $languageCode
     */
    public function setLanguageCode(string $languageCode): void
    {
        $this->languageCode = $languageCode;
    }

    /**
     * @return array
     */
    public function getCountries(): array
    {
        return $this->countries;
    }

    /**
     * @param array $countries
     */
    public function setCountries(array $countries): void
    {
        $this->countries = $countries;
    }
}
