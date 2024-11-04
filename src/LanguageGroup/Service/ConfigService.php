<?php declare(strict_types=1);

namespace LanguageGroup\Service;

final readonly class ConfigService implements ConfigServiceInterface
{
    public function __construct(private array $config)
    {
    }

    public function getApiUrlSearchByCountryFullName(string $country): string
    {
        $apiUrl = $this->config['rest_countries_api_url']['search_by_country_full_name'];

        return str_replace('{name}', $country, $apiUrl);
    }

    public function getApiUrlSearchByLanguageCode(string $languageCode): string
    {
        $apiUrl = $this->config['rest_countries_api_url']['search_by_language_code'];

        return str_replace('{code}', $languageCode, $apiUrl);
    }

    public function getErrorLogFile(): string
    {
        return BASE_DIR
            . '/' . $this->config['error_log']['directory']
            . '/' . $this->config['error_log']['file_name'];
    }
}
