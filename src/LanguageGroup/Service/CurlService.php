<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Class CurlService
 * @package LanguageGroup\Service
 */
class CurlService implements CurlServiceInterface
{
    /**
     * @var \CurlHandle|false
     */
    private \CurlHandle|false $ch;

    /**
     * @param array $headers
     */
    private function init(array $headers): void
    {
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($this->ch, CURLOPT_FORBID_REUSE, true);
        curl_setopt($this->ch, CURLOPT_USERAGENT, php_uname());
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
    }

    /**
     * @param string $url
     * @param array $headers
     * @return string
     * @throws \UnexpectedValueException
     */
    public function get(string $url, array $headers): string
    {
        $this->init($headers);

        curl_setopt($this->ch, CURLOPT_URL, $url);

        $response = curl_exec($this->ch);

        if (curl_errno($this->ch)) {
            throw new \UnexpectedValueException(
                sprintf('Invalid cURL response. Error: %s', curl_errno($this->ch))
            );
        }

        curl_close($this->ch);

        return $response;
    }
}
