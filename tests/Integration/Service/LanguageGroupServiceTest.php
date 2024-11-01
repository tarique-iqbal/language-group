<?php declare(strict_types=1);

namespace Tests\Integration\Service;

use LanguageGroup\Container\ContainerFactory;
use LanguageGroup\Entity\LanguageGroup;
use LanguageGroup\Service\CurlServiceInterface;
use LanguageGroup\Service\LanguageGroupServiceInterface;
use PHPUnit\Framework\TestCase;

class LanguageGroupServiceTest extends TestCase
{
    protected CurlServiceInterface $curlService;

    protected LanguageGroupServiceInterface $languageGroupService;

    protected function setUp(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';
        $container = (new ContainerFactory($config))->create();
        $container['CurlService'] = $this
            ->getMockBuilder(CurlServiceInterface::class)
            ->getMock();

        $this->curlService = $container['CurlService'];
        $this->languageGroupService = $container['LanguageGroupService'];
    }

    public function testGetResultForCountry(): void
    {
        $this->curlService
            ->expects($this->any())
            ->method('get')
            ->willReturn(
                '[{"languages":[{"iso639_1":"it"}],"name":"Italy"}]',
                '[{"name":"Holy See"},{"name":"Italy"},{"name":"San Marino"},{"name":"Switzerland"}]'
            );

        $languageGroups = $this->languageGroupService->getResultForCountry('Italy');

        $this->assertContainsOnlyInstancesOf(LanguageGroup::class, $languageGroups);
        $this->assertEquals(4, count($languageGroups[0]->getCountries()));
    }

    public function testGetResultForCountrySpeaksMultipleLanguages(): void
    {
        $this->curlService
            ->expects($this->any())
            ->method('get')
            ->willReturn(
                '[{"languages":[{"iso639_1":"de"},{"iso639_1":"fr"},{"iso639_1":"it"}],"name":"Switzerland"}]',
                '[{"name":"Austria"},{"name":"Belgium"},{"name":"Germany"},{"name":"Holy See"},'
                . '{"name":"Liechtenstein"},{"name":"Luxembourg"},{"name":"Switzerland"}]',
                '[{"name":"Belgium"},{"name":"Benin"},{"name":"Burkina Faso"},{"name":"Burundi"},{"name":"Cameroon"},'
                . '{"name":"Canada"},{"name":"Central African Republic"},{"name":"Chad"},{"name":"Comoros"},'
                . '{"name":"Congo"},{"name":"Congo (Democratic Republic of the)"},{"name":"Djibouti"},'
                . '{"name":"Equatorial Guinea"},{"name":"France"},{"name":"French Guiana"},{"name":"French Polynesia"},'
                . '{"name":"French Southern Territories"},{"name":"Gabon"},{"name":"Guadeloupe"},{"name":"Guernsey"},'
                . '{"name":"Guinea"},{"name":"Haiti"},{"name":"Holy See"},{"name":"Côte d\'Ivoire"},{"name":"Jersey"},'
                . '{"name":"Lebanon"},{"name":"Luxembourg"},{"name":"Madagascar"},{"name":"Mali"},'
                . '{"name":"Martinique"},{"name":"Mayotte"},{"name":"Monaco"},{"name":"New Caledonia"},'
                . '{"name":"Niger"},{"name":"Réunion"},{"name":"Rwanda"},{"name":"Saint Barthélemy"},'
                . '{"name":"Saint Martin (French part)"},{"name":"Saint Pierre and Miquelon"},{"name":"Senegal"},'
                . '{"name":"Seychelles"},{"name":"Switzerland"},{"name":"Togo"},{"name":"Vanuatu"},'
                . '{"name":"Wallis and Futuna"}]',
                '[{"name":"Holy See"},{"name":"Italy"},{"name":"San Marino"},{"name":"Switzerland"}]'
            );

        $languageGroups = $this->languageGroupService->getResultForCountry('Switzerland');

        $this->assertContainsOnlyInstancesOf(LanguageGroup::class, $languageGroups);
        $this->assertEquals(7, count($languageGroups[0]->getCountries()));
        $this->assertEquals(45, count($languageGroups[1]->getCountries()));
        $this->assertEquals(4, count($languageGroups[2]->getCountries()));
    }
}
