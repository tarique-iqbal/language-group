<?php declare(strict_types=1);

namespace LanguageGroup;

use LanguageGroup\Exception\FileNotFoundException;
use LanguageGroup\Exception\ValidationFailedException;
use LanguageGroup\Service\CliArgsServiceInterface;
use LanguageGroup\Service\LanguageGroupServiceInterface;
use LanguageGroup\Service\TemplateServiceInterface;
use LanguageGroup\Validator\Validator;

final readonly class LanguageGroupApplication
{
    private const INPUT_MIN_LENGTH = 1;

    private const INPUT_MAX_LENGTH = 2;

    public function __construct(
        private CliArgsServiceInterface $cliArgsService,
        private LanguageGroupServiceInterface $languageGroupService,
        private TemplateServiceInterface $templateService,
    ) {
    }

    /**
     * @throws FileNotFoundException
     * @throws ValidationFailedException
     */
    public function speak(): void
    {
        $countries = $this->cliArgsService->getArgs();

        Validator::validate($countries, self::INPUT_MIN_LENGTH, self::INPUT_MAX_LENGTH);

        $languageGroups = $this->languageGroupService->getResultForCountry($countries[0]);

        $this->templateService->render(
            BASE_DIR . '/src/LanguageGroup/Template/language_group',
            [
                'countries' => $countries,
                'language_groups' => $languageGroups,
                'maximum_input_size' => self::INPUT_MAX_LENGTH
            ]
        );
    }
}
