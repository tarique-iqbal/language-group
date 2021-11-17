<?php

foreach ($language_groups as $language_group) {
    if ((count($language_group->getCountries()) > 1)) {
        $otherCounties = [];

        foreach ($language_group->getCountries() as $country) {
            if ($countries[0] !== $country->getName()) {
                $otherCounties[] = $country->getName();
            }
        }

        $output_string = sprintf(
            '%s speaks same language with these countries: %s',
            $countries[0],
            implode(', ', $otherCounties)
        );
    } else {
        $output_string = sprintf(
            '%s does not speak the same language with any other country.',
            $countries[0]
        );
    }

    echo 'Country language code: ' . $language_group->getLanguageCode() . PHP_EOL;
    echo $output_string . PHP_EOL;
}
