<?php declare(strict_types=1);

namespace LanguageGroup\Container;

use LanguageGroup\Handler\ExceptionHandler;
use LanguageGroup\LanguageGroupApplication;
use LanguageGroup\Service\CliArgsService;
use LanguageGroup\Service\ConfigService;
use LanguageGroup\Service\CurlService;
use LanguageGroup\Service\LanguageGroupService;
use LanguageGroup\Service\RestCountriesService;
use LanguageGroup\Service\TemplateService;
use Pimple\Container;

readonly class ContainerFactory
{
    public function __construct(private array $config)
    {
    }

    public function create(): Container
    {
        $container = new Container();

        $container['ConfigService'] = function () {
            return new ConfigService($this->config);
        };

        $container['CurlService'] = function () {
            return new CurlService();
        };

        $container['RestCountriesService'] = function (Container $c) {
            return new RestCountriesService(
                $c['ConfigService'],
                $c['CurlService']
            );
        };

        $container['LanguageGroupService'] = function (Container $c) {
            return new LanguageGroupService(
                $c['RestCountriesService']
            );
        };

        $container['TemplateService'] = function () {
            return new TemplateService();
        };

        $container['CliArgsService'] = function () {
            return new CliArgsService();
        };

        $container['LanguageGroupApplication'] = function (Container $c) {
            return new LanguageGroupApplication(
                $c['CliArgsService'],
                $c['LanguageGroupService'],
                $c['TemplateService']
            );
        };

        $container['ExceptionHandler'] = function (Container $c) {
            return new ExceptionHandler(
                $c['ConfigService']
            );
        };

        return $container;
    }
}
