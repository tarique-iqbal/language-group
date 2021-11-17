<?php declare(strict_types=1);

namespace LanguageGroup\Validator;

/**
 * Class CountryNameValidator
 * @package LanguageGroup\Validator
 */
class CountryNameValidator
{
    /**
     * @var string
     */
    private string $errorMessage;

    /**
     * @param string $countryName
     * @return bool
     */
    public function isValid(string $countryName): bool
    {
        if (!preg_match('/^[a-zA-Z\Å\ô\é\ \-\(\),\.\']+$/', $countryName)) {
            $this->errorMessage
                = 'Country name can contain alphabets, special characters [Åôé()-,.\'] and space only.';

            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
