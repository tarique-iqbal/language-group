<?php declare(strict_types=1);

namespace Tests\Unit\Validator;

use LanguageGroup\Validator\CountryNameValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class CountryNameValidatorTest extends TestCase
{
    public static function addCountryNameDataProvider(): array
    {
        return [
            [
                '', false
            ],
            [
                '@;<?Invalid#Character', false
            ],
            [
                'San Marino', true
            ],
            [
                'Switzerland', true
            ],
        ];
    }

    #[DataProvider('addCountryNameDataProvider')]
    public function testIsValid(string $countryName, bool $expectedStatus): void
    {
        $countryNameValidator = new CountryNameValidator();
        $status = $countryNameValidator->isValid($countryName);

        $this->assertSame($expectedStatus, $status);
    }
}
