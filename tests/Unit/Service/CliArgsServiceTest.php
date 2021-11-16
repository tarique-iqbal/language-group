<?php declare(strict_types=1);

namespace Tests\Unit\Service;

use LanguageGroup\Service\CliArgsService;
use PHPUnit\Framework\TestCase;

class CliArgsServiceTest extends TestCase
{
    private const FILE = 'index.php';

    public function addCliArgsDataProvider(): array
    {
        return [
            [
                [self::FILE], 0, []
            ],
            [
                [self::FILE, 'Value'], 1, ['Value']
            ],
            [
                [self::FILE, 'Germany', 'Åland Islands'], 2, ['Germany', 'Åland Islands']
            ],
        ];
    }

    /**
     * @dataProvider addCliArgsDataProvider
     */
    public function testGetArgs(array $arguments, int $countExpected, array $resultExpected): void
    {
        $_SERVER['argv'] = $arguments;

        $cliArgsService = new CliArgsService();
        $result = $cliArgsService->getArgs();

        $this->assertSame($resultExpected, $result);
        $this->assertEquals($countExpected, count($result));
    }
}
