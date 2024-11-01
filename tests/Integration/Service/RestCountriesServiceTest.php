<?php declare(strict_types=1);

namespace Tests\Integration\Service;

use LanguageGroup\Container\ContainerFactory;
use LanguageGroup\Service\CurlServiceInterface;
use LanguageGroup\Service\RestCountriesServiceInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RestCountriesServiceTest extends TestCase
{
    protected CurlServiceInterface $curlService;

    protected RestCountriesServiceInterface $restCountriesService;

    protected function setUp(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';
        $container = (new ContainerFactory($config))->create();
        $container['CurlService'] = $this
            ->getMockBuilder(CurlServiceInterface::class)
            ->getMock();

        $this->curlService = $container['CurlService'];
        $this->restCountriesService = $container['RestCountriesService'];
    }

    public function testSearchByCountryFullName(): void
    {
        $jsonString = '[{"languages":[{"iso639_1":"en"},{"iso639_1":"fr"}],"name":"Canada"}]';
        $countryExpected = json_decode($jsonString);

        $this->curlService
            ->method('get')
            ->willReturn($jsonString);

        $country = $this->restCountriesService->searchByCountryFullName('Canada');

        $this->assertEquals($countryExpected, $country);
        $this->assertContainsOnlyInstancesOf(\stdClass::class, $country);
    }

    public static function addUnexpectedResponseProvider(): array
    {
        return [
            [json_encode('')],
            [json_encode(null)],
            [json_encode(false)],
            [json_encode('dummyString')],
            ['{"status":404,"message":"Not Found"}'],
        ];
    }

    #[DataProvider('addUnexpectedResponseProvider')]
    public function testSearchByCountryFullNameInvalidResponseFromCurlService(string $response): void
    {
        $this->expectException(\UnexpectedValueException::class);

        $this->curlService
            ->method('get')
            ->willReturn($response);

        $this->restCountriesService->searchByCountryFullName('Spain');
    }

    public function testSearchByLanguageCode(): void
    {
        $jsonString = '[{"name":"Holy See"},{"name":"Italy"},{"name":"San Marino"},{"name":"Switzerland"}]';
        $languageSpeakCountriesExpected = json_decode($jsonString);

        $this->curlService
            ->method('get')
            ->willReturn($jsonString);

        $languageSpeakCountries = $this->restCountriesService->searchByLanguageCode('it');

        $this->assertEquals($languageSpeakCountriesExpected, $languageSpeakCountries);
        $this->assertContainsOnlyInstancesOf(\stdClass::class, $languageSpeakCountries);
    }

    #[DataProvider('addUnexpectedResponseProvider')]
    public function testSearchByLanguageCodeInvalidResponseFromCurlService(string $response): void
    {
        $this->expectException(\UnexpectedValueException::class);

        $this->curlService
            ->method('get')
            ->willReturn($response);

        $this->restCountriesService->searchByLanguageCode('en');
    }
}
