<?php declare(strict_types=1);

namespace LanguageGroup\Validator;

class ArraySizeValidator
{
    private string $errorMessage;

    public function isValid(array $array, int $minSize, int $maxSize): bool
    {
        if (count($array) < $minSize || count($array) > $maxSize) {
            $this->errorMessage = 'Invalid input length.';

            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
