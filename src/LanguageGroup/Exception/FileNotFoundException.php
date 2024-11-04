<?php declare(strict_types=1);

namespace LanguageGroup\Exception;

class FileNotFoundException extends \Exception
{
    public function __construct(string $message = null, int $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
