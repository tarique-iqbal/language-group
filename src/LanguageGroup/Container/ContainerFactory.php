<?php declare(strict_types=1);

namespace LanguageGroup\Container;

use LanguageGroup\Service\ConfigService;
use LanguageGroup\Service\CurlService;
use LanguageGroup\Service\LanguageGroupService;
use LanguageGroup\Service\RestCountriesService;
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

        return $container;
    }
}
