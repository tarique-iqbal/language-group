<?php declare(strict_types=1);

namespace Tests\Unit\Handler;

use LanguageGroup\Handler\ExceptionHandler;
use LanguageGroup\Service\ConfigServiceInterface;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\TestCase;

class ExceptionHandlerTest extends TestCase
{
    public function testReport(): void
    {
        $this->setOutputCallback(function () {
        });

        $structure = [
            'logs' => [

            ]
        ];
        $root = vfsStream::setup(sys_get_temp_dir(), null, $structure);

        $configService = $this
            ->getMockBuilder(ConfigServiceInterface::class)
            ->getMock();
        $configService->method('getErrorLogFile')->willReturn(
            $root->url() . '/logs/errors.log'
        );

        $message = 'Exception message to write in log file.';

        (new ExceptionHandler($configService))->report(new \Exception($message));

        $this->assertTrue($root->hasChild('logs/errors.log'));
        $this->assertSame(
            'Exception message to write in log file.' . PHP_EOL,
            $root->getChild('logs/errors.log')->getContent()
        );
    }
}
