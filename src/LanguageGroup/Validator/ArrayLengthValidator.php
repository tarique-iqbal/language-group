<?php declare(strict_types=1);

namespace LanguageGroup\Validator;

final class ArrayLengthValidator extends BaseValidator
{
    private const MESSAGE = 'Value should be an array of length in between %d and %d.';

    public function __construct(
        private readonly mixed $value,
        private readonly int $minLength,
        private readonly int $maxLength,
    ) {
    }

    public function validate(array $context = []): ?bool
    {
        if (!is_array($this->value)) {
            return null;
        }

        if (count($this->value) < $this->minLength || count($this->value) > $this->maxLength) {
            $this->addError(
                sprintf($this->message ?? self::MESSAGE, $this->minLength, $this->maxLength)
            );

            return false;
        }

        return true;
    }
}
