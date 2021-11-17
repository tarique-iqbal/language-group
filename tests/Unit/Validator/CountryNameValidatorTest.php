<?php declare(strict_types=1);

namespace Tests\Unit\Validator;

use LanguageGroup\Validator\CountryNameValidator;
use PHPUnit\Framework\TestCase;

class CountryNameValidatorTest extends TestCase
{
    public function addCountryNameDataProvider(): array
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

    /**
     * @dataProvider addCountryNameDataProvider
     */
    public function testIsValid(string $countryName, bool $expectedStatus): void
    {
        $countryNameValidator = new CountryNameValidator();
        $status = $countryNameValidator->isValid($countryName);

        $this->assertSame($expectedStatus, $status);
    }
}
