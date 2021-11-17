<?php declare(strict_types=1);

namespace LanguageGroup\Validator;

/**
 * Class ArraySizeValidator
 * @package LanguageGroup\Validator
 */
class ArraySizeValidator
{
    /**
     * @var string
     */
    private string $errorMessage;

    /**
     * @param array $array
     * @param int $minSize
     * @param int $maxSize
     * @return bool
     */
    public function isValid(array $array, int $minSize, int $maxSize): bool
    {
        if (count($array) < $minSize || count($array) > $maxSize) {
            $this->errorMessage = 'Invalid input length.';

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
