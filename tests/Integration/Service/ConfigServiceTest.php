<?php declare(strict_types=1);

namespace Tests\Integration\Service;

use LanguageGroup\Service\ConfigService;
use PHPUnit\Framework\TestCase;

class ConfigServiceTest extends TestCase
{
    protected array $config;

    protected ConfigService $configService;

    protected function setUp(): void
    {
        $this->config = include BASE_DIR . '/config/parameters.php';
        $this->configService = new ConfigService($this->config);
    }

    public function testGetApiUrlSearchByCountryFullName(): void
    {
        $countryName = 'Germany';
        $apiUrl = $this->configService->getApiUrlSearchByCountryFullName($countryName);

        $expectedApiUrl = $this->config['rest_countries_api_url']['search_by_country_full_name'];
        $expectedApiUrl = str_replace('{name}', $countryName, $expectedApiUrl);

        $this->assertSame($expectedApiUrl, $apiUrl);
    }

    public function testGetApiUrlSearchByLanguageCode(): void
    {
        $languageCode = 'de';
        $apiUrl = $this->configService->getApiUrlSearchByLanguageCode($languageCode);

        $expectedApiUrl = $this->config['rest_countries_api_url']['search_by_language_code'];
        $expectedApiUrl = str_replace('{code}', $languageCode, $expectedApiUrl);

        $this->assertSame($expectedApiUrl, $apiUrl);
    }

    public function testGetErrorLogFile(): void
    {
        $logFile = $this->configService->getErrorLogFile();
        $expectedLogFile = BASE_DIR
            . '/' . $this->config['error_log']['directory']
            . '/' . $this->config['error_log']['file_name'];

        $this->assertSame($expectedLogFile, $logFile);
    }
}
