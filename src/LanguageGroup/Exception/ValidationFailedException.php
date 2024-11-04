<?php declare(strict_types=1);

namespace LanguageGroup\Exception;

final class ValidationFailedException extends \Exception
{
    public function __construct(array $value)
    {
        parent::__construct(implode(PHP_EOL, $value));
    }
}