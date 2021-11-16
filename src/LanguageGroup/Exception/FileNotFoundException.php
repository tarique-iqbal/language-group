<?php declare(strict_types=1);

namespace LanguageGroup\Exception;

/**
 * Class FileNotFoundException
 * @package LanguageGroup\Exception
 */
class FileNotFoundException extends \Exception
{
    /**
     * @param string|null $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct(string $message = null, int $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
