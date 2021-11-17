<?php

foreach ($language_groups as $language_group) {
    $country = array_filter(
        $language_group->getCountries(),
        function ($object) use ($countries) {
            return $object->getName() === $countries[1];
        }
    );

    $output_string = count($country) > 0
        ? sprintf('%s and %s speak the same language.', $countries[0], $countries[1])
        : sprintf('%s and %s do not speak the same language.', $countries[0], $countries[1]);

    echo 'Country language code: ' . $language_group->getLanguageCode() . PHP_EOL;
    echo $output_string . PHP_EOL;
}
