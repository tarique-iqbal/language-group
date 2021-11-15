<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Interface CurlServiceInterface
 * @package LanguageGroup\Service
 */
interface CurlServiceInterface
{
    /**
     * @param string $url
     * @param array $headers
     * @return string
     * @throws \UnexpectedValueException
     */
    public function get(string $url, array $headers): string;
}
