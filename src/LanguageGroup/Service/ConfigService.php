<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Class ConfigService
 * @package LanguageGroup\Service
 */
class ConfigService implements ConfigServiceInterface
{
    /**
     * @var array
     */
    private array $config = [];

    /**
     * ConfigService constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $country
     * @return string
     */
    public function getApiUrlSearchByCountryFullName(string $country): string
    {
        $apiUrl = $this->config['rest_countries_api_url']['search_by_country_full_name'];

        return str_replace('{name}', $country, $apiUrl);
    }

    /**
     * @param string $languageCode
     * @return string
     */
    public function getApiUrlSearchByLanguageCode(string $languageCode): string
    {
        $apiUrl = $this->config['rest_countries_api_url']['search_by_language_code'];

        return str_replace('{code}', $languageCode, $apiUrl);
    }

    /**
     * @return string
     */
    public function getErrorLogFile(): string
    {
        return BASE_DIR
            . '/' . $this->config['error_log']['directory']
            . '/' . $this->config['error_log']['file_name'];
    }
}
