<?php declare(strict_types=1);

namespace Tests\Unit\Validator;

use LanguageGroup\Validator\ArraySizeValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ArraySizeValidatorTest extends TestCase
{
    public static function addArraySizeDataProvider(): array
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

    #[DataProvider('addArraySizeDataProvider')]
    public function testIsValid(array $array, int $minSize, int $maxSize, bool $expectedStatus): void
    {
        $arraySizeValidator = new ArraySizeValidator();
        $status = $arraySizeValidator->isValid($array, $minSize, $maxSize);

        $this->assertSame($expectedStatus, $status);
    }
}
