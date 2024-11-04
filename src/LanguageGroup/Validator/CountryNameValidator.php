<?php declare(strict_types=1);

namespace LanguageGroup\Validator;

class CountryNameValidator
{
    private string $errorMessage;

    public function isValid(string $countryName): bool
    {
        if (!preg_match('/^[a-zA-Z\Å\ô\é\ \-\(\),\.\']+$/', $countryName)) {
            $this->errorMessage
                = 'Country name can contain alphabets, special characters [Åôé()-,.\'] and space only.';

            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
