<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Class RestCountriesService
 * @package LanguageGroup\Service
 */
class RestCountriesService implements RestCountriesServiceInterface
{
    /**
     * @var array
     */
    private array $headers;

    /**
     * @var ConfigServiceInterface
     */
    private ConfigServiceInterface $configService;

    /**
     * @var CurlServiceInterface
     */
    private CurlServiceInterface $curlService;

    /**
     * RestCountriesService constructor.
     * @param ConfigServiceInterface $configService
     * @param CurlServiceInterface $curlService
     */
    public function __construct(ConfigServiceInterface $configService, CurlServiceInterface $curlService)
    {
        $this->headers = [
            'Content-Type: application/json; charset=utf-8'
        ];

        $this->configService = $configService;
        $this->curlService = $curlService;
    }

    /**
     * @param string $countryName
     * @return array
     * @throws \UnexpectedValueException
     */
    public function searchByCountryFullName(string $countryName): array
    {
        $apiUrl = $this->configService->getApiUrlSearchByCountryFullName($countryName);

        $response = $this->curlService->get($apiUrl, $this->headers);
        $country = json_decode($response);

        if (!is_array($country)) {
            throw new \UnexpectedValueException(
                'Unexpected country search result found in REST countries service.'
            );
        }

        return $country;
    }

    /**
     * @param string $languageCode
     * @return array
     * @throws \UnexpectedValueException
     */
    public function searchByLanguageCode(string $languageCode): array
    {
        $apiUrl = $this->configService->getApiUrlSearchByLanguageCode($languageCode);

        $response = $this->curlService->get($apiUrl, $this->headers);
        $language = json_decode($response);

        if (!is_array($language)) {
            throw new \UnexpectedValueException(
                'Unexpected language search result found in REST countries service.'
            );
        }

        return $language;
    }
}
