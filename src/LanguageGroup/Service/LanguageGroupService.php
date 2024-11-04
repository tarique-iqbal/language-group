<?php declare(strict_types=1);

namespace LanguageGroup\Service;

use LanguageGroup\Entity\Country;
use LanguageGroup\Entity\LanguageGroup;

final readonly class LanguageGroupService implements LanguageGroupServiceInterface
{
    public function __construct(private RestCountriesServiceInterface $restCountriesService)
    {
    }

    /**
     * @return LanguageGroup[]
     */
    public function getResultForCountry(string $countryName): array
    {
        $restCountry = $this->restCountriesService->searchByCountryFullName($countryName);

        $languageGroups = [];

        foreach ($restCountry[0]->languages as $language) {
            $languageSpeakCountries = $this->restCountriesService->searchByLanguageCode($language->iso639_1);

            $countries = [];
            foreach ($languageSpeakCountries as $value) {
                $country = new Country();
                $country->setName($value->name);
                $countries[] = $country;
            }

            $languageGroup = new LanguageGroup();
            $languageGroup->setLanguageCode($language->iso639_1);
            $languageGroup->setCountries($countries);

            $languageGroups[] = $languageGroup;
        }

        return $languageGroups;
    }
}
