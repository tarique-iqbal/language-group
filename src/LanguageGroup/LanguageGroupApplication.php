<?php declare(strict_types=1);

namespace LanguageGroup;

use LanguageGroup\Exception\FileNotFoundException;
use LanguageGroup\Service\CliArgsServiceInterface;
use LanguageGroup\Service\LanguageGroupServiceInterface;
use LanguageGroup\Service\TemplateServiceInterface;
use LanguageGroup\Validator\ArraySizeValidator;
use LanguageGroup\Validator\CountryNameValidator;

final readonly class LanguageGroupApplication
{
    private const MINIMUM_INPUT_SIZE = 1;

    private const MAXIMUM_INPUT_SIZE = 2;

    public function __construct(
        private CliArgsServiceInterface $cliArgsService,
        private LanguageGroupServiceInterface $languageGroupService,
        private TemplateServiceInterface $templateService,
    ) {
    }

    /**
     * @throws FileNotFoundException
     */
    public function speak(): void
    {
        $countries = $this->cliArgsService->getArgs();

        if ($this->validateInput($countries) === true) {
            $languageGroups = $this->languageGroupService->getResultForCountry($countries[0]);

            $this->templateService->render(
                BASE_DIR . '/src/LanguageGroup/Template/language_group',
                [
                    'countries' => $countries,
                    'language_groups' => $languageGroups,
                    'maximum_input_size' => self::MAXIMUM_INPUT_SIZE
                ]
            );
        }
    }

    /**
     * @throws FileNotFoundException
     */
    private function validateInput(array $countries): bool
    {
        $minSize = self::MINIMUM_INPUT_SIZE;
        $maxSize = self::MAXIMUM_INPUT_SIZE;
        $arraySizeValidator = new ArraySizeValidator();

        if ($arraySizeValidator->isValid($countries, $minSize, $maxSize) === false) {
            $this->displayErrorMessage($arraySizeValidator->getErrorMessage());

            return false;
        }

        $countryNameValidator = new CountryNameValidator();

        foreach ($countries as $countryName) {
            if ($countryNameValidator->isValid($countryName) === false) {
                $this->displayErrorMessage($countryNameValidator->getErrorMessage());

                return false;
            }
        }

        return true;
    }

    /**
     * @throws FileNotFoundException
     */
    private function displayErrorMessage(string $message): void
    {
        $this->templateService->render(
            BASE_DIR . '/src/LanguageGroup/Template/error_message',
            [
                'message' => $message
            ]
        );
    }
}
