<?php declare(strict_types=1);

namespace Tests\Unit\Service;

use LanguageGroup\Exception\FileNotFoundException;
use LanguageGroup\Service\TemplateService;
use PHPUnit\Framework\TestCase;

class TemplateServiceTest extends TestCase
{
    public function testRenderFileNotFound(): void
    {
        $this->expectException(FileNotFoundException::class);

        $templateService = new TemplateService();

        $templateService->render('/path/to/invalid/file/location', []);
    }
}
