<?php declare(strict_types=1);

namespace LanguageGroup\Service;

/**
 * Class RestCountriesService
 * @package LanguageGroup\Service
 */
final class RestCountriesService implements RestCountriesServiceInterface
{
    /**
     * @var array
     */
    private array $headers;

    /**
     * RestCountriesService constructor.
     * @param ConfigServiceInterface $configService
     * @param CurlServiceInterface $curlService
     */
    public function __construct(
        private readonly ConfigServiceInterface $configService,
        private readonly CurlServiceInterface $curlService,
    ) {
        $this->headers = [
            'Content-Type: application/json; charset=utf-8'
        ];
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
