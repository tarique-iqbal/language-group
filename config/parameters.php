<?php declare(strict_types=1);

$config = [
    'rest_countries_api_url' => [
        'search_by_country_full_name'
            => 'https://restcountries.com/v2/name/{name}?fullText=true&fields=languages;name',
        'search_by_language_code' => 'https://restcountries.com/v2/lang/{code}?fields=name'
    ],
];

return $config;
