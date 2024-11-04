<?php declare(strict_types=1);

namespace LanguageGroup\Service;

final class RestCountriesService implements RestCountriesServiceInterface
{
    private array $headers;

    public function __construct(
        private readonly ConfigServiceInterface $configService,
        private readonly CurlServiceInterface $curlService,
    ) {
        $this->headers = [
            'Content-Type: application/json; charset=utf-8'
        ];
    }

    /**
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
