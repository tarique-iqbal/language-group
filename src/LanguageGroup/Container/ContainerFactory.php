<?php declare(strict_types=1);

namespace LanguageGroup\Container;

use LanguageGroup\LanguageGroupApplication;
use LanguageGroup\Service\CliArgsService;
use LanguageGroup\Service\ConfigService;
use LanguageGroup\Service\CurlService;
use LanguageGroup\Service\LanguageGroupService;
use LanguageGroup\Service\RestCountriesService;
use LanguageGroup\Service\TemplateService;
use Pimple\Container;

/**
 * Class ContainerFactory
 * @package LanguageGroup\Container
 */
class ContainerFactory
{
    /**
     * @var array
     */
    private array $config;

    /**
     * ContainerFactory constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @return Container
     */
    public function create(): Container
    {
        $container = new Container();

        $container['ConfigService'] = function () {
            return new ConfigService($this->config);
        };

        $container['CurlService'] = function () {
            return new CurlService();
        };

        $container['RestCountriesService'] = function ($c) {
            return new RestCountriesService(
                $c['ConfigService'],
                $c['CurlService']
            );
        };

        $container['LanguageGroupService'] = function ($c) {
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

        $container['LanguageGroupApplication'] = function ($c) {
            return new LanguageGroupApplication(
                $c['CliArgsService'],
                $c['LanguageGroupService'],
                $c['TemplateService']
            );
        };

        return $container;
    }
}
