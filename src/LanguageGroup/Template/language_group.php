<?php

if (count($countries) === $maximum_input_size) {
    $this->render(
        BASE_DIR . '/src/LanguageGroup/Template/both_countries_speak_same_language',
        [
            'countries' => $countries,
            'language_groups' => $language_groups
        ]
    );
} else {
    $this->render(
        BASE_DIR . '/src/LanguageGroup/Template/countries_speak_same_language',
        [
            'countries' => $countries,
            'language_groups' => $language_groups
        ]
    );
}
