<?php declare(strict_types=1);

namespace LanguageGroup\Service;

interface CurlServiceInterface
{
    /**
     * @throws \UnexpectedValueException
     */
    public function get(string $url, array $headers): string;
}
