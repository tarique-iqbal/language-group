<?php declare(strict_types=1);

namespace Tests\Integration\Container;

use LanguageGroup\Container\ContainerFactory;
use LanguageGroup\Service\ConfigService;
use LanguageGroup\Service\CurlService;
use LanguageGroup\Service\RestCountriesService;
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
    }
}
