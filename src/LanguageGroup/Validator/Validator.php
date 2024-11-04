<?php declare(strict_types=1);

namespace LanguageGroup\Validator;

use LanguageGroup\Exception\ValidationFailedException;

class Validator
{
    /**
     * @throws ValidationFailedException
     */
    public static function validate(array $countries, $minLength, $maxLength): void
    {
        $arrayLengthValidator = new ArrayLengthValidator($countries, $minLength, $maxLength);
        $arrayLengthValidator->setMessage(
            sprintf('Input length should be in between %d and %d.', $minLength, $maxLength)
        );

        $compositeValidator = new CompositeValidator();
        $compositeValidator->addValidator($arrayLengthValidator)
            ->addValidator(new CountryNameValidator(array_key_exists(0, $countries) ? $countries[0] : null))
            ->addValidator(new CountryNameValidator(array_key_exists(1, $countries) ? $countries[1] : null));

        if ($compositeValidator->validate() === false) {
            throw new ValidationFailedException($compositeValidator->getErrors());
        }
    }
}
