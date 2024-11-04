<?php declare(strict_types=1);

namespace Tests\Unit\Validator;

use LanguageGroup\Validator\ArrayLengthValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ArrayLengthValidatorTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [
                [], 1, 2, false
            ],
            [
                ['', '', ''], 1, 2, false
            ],
            [
                ['Belgium', 'Benin', 'Burundi'], 1, 2, false
            ],
            [
                ['Switzerland', 'Senegal', 'Burundi'], 1, 2, false
            ],
            [
                ['Senegal'], 1, 2, true
            ],
            [
                ['Senegal', 'Switzerland'], 1, 2, true
            ],
        ];
    }

    #[DataProvider('dataProvider')]
    public function testValidate(array $array, int $minLength, int $maxLength, bool $expectedStatus): void
    {
        $arraySizeValidator = new ArrayLengthValidator($array, $minLength, $maxLength);
        $status = $arraySizeValidator->validate();

        $this->assertSame($expectedStatus, $status);
    }
}
