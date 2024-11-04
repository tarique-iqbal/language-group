<?php declare(strict_types=1);

namespace LanguageGroup\Validator;

interface ValidatorInterface
{
    public function validate(array $context = []): ?bool;

    public function getErrors(): array;
}
