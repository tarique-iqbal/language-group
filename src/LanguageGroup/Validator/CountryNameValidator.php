<?php declare(strict_types=1);

namespace LanguageGroup\Validator;

class CountryNameValidator extends BaseValidator
{
    public function __construct(private readonly mixed $value)
    {
    }

    private const MESSAGE = 'Country name can contain alphabets, special characters [Åôé()-,.\'] and space only.';

    public function validate(array $context = []): ?bool
    {
        if (!is_string($this->value)) {
            return null;
        }

        if (!preg_match('/^[a-zA-Z\Å\ô\é\ \-\(\),\.\']+$/', $this->value)) {
            $this->addError($this->message ?? self::MESSAGE);

            return false;
        }

        return true;
    }
}
