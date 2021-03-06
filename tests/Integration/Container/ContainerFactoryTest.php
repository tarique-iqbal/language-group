<?php declare(strict_types=1);

namespace Tests\Integration\Container;

use LanguageGroup\Container\ContainerFactory;
use LanguageGroup\Handler\ExceptionHandler;
use LanguageGroup\LanguageGroupApplication;
use LanguageGroup\Service\CliArgsService;
use LanguageGroup\Service\ConfigService;
use LanguageGroup\Service\CurlService;
use LanguageGroup\Service\LanguageGroupService;
use LanguageGroup\Service\RestCountriesService;
use LanguageGroup\Service\TemplateService;
use PHPUnit\Framework\TestCase;
use Pimple\Container;

class ContainerFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';

        $container = (new ContainerFactory($config))->create();

        $this->assertInstanceOf(Container::class, $container);
        $this->assertInstanceOf(ConfigService::class, $container['ConfigService']);
        $this->assertInstanceOf(CurlService::class, $container['CurlService']);
        $this->assertInstanceOf(RestCountriesService::class, $container['RestCountriesService']);
        $this->assertInstanceOf(LanguageGroupService::class, $container['LanguageGroupService']);
        $this->assertInstanceOf(TemplateService::class, $container['TemplateService']);
        $this->assertInstanceOf(CliArgsService::class, $container['CliArgsService']);
        $this->assertInstanceOf(LanguageGroupApplication::class, $container['LanguageGroupApplication']);
        $this->assertInstanceOf(ExceptionHandler::class, $container['ExceptionHandler']);
    }
}
