<?php declare(strict_types=1);

namespace Tests\Integration;

use LanguageGroup\Container\ContainerFactory;
use LanguageGroup\Service\CliArgsServiceInterface;
use LanguageGroup\Service\CurlServiceInterface;
use PHPUnit\Framework\TestCase;

class LanguageGroupApplicationTest extends TestCase
{
    protected $curlService;

    protected $cliArgsService;

    protected $languageGroupApplication;

    protected function setUp(): void
    {
        $config = include BASE_DIR . '/config/parameters_test.php';
        $container = (new ContainerFactory($config))->create();
        $container['CurlService'] = $this
            ->getMockBuilder(CurlServiceInterface::class)
            ->getMock();
        $container['CliArgsService'] = $this
            ->getMockBuilder(CliArgsServiceInterface::class)
            ->getMock();

        $this->curlService = $container['CurlService'];
        $this->cliArgsService = $container['CliArgsService'];
        $this->languageGroupApplication = $container['LanguageGroupApplication'];
    }

    public function testSpeak(): void
    {
        $this->cliArgsService
            ->method('getArgs')
            ->willReturn(['Italy']);
        $this->curlService
            ->expects($this->any())
            ->method('get')
            ->will($this->onConsecutiveCalls(
                '[{"languages":[{"iso639_1":"it"}],"name":"Italy"}]',
                '[{"name":"Holy See"},{"name":"Italy"},{"name":"San Marino"},{"name":"Switzerland"}]'
            ));

        $this->expectOutputString(
            'Country language code: it' . PHP_EOL
            . 'Italy speaks same language with these countries: Holy See, San Marino, Switzerland' . PHP_EOL
        );

        $this->languageGroupApplication->speak();
    }

    public function testSpeakCountrySpeaksMultipleLanguages(): void
    {
        $this->cliArgsService
            ->method('getArgs')
            ->willReturn(['Switzerland']);
        $this->curlService
            ->expects($this->any())
            ->method('get')
            ->will($this->onConsecutiveCalls(
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
            ));

        $this->expectOutputString(
            'Country language code: de' . PHP_EOL
            . 'Switzerland speaks same language with these countries: Austria, Belgium, Germany, Holy See,'
            . ' Liechtenstein, Luxembourg' . PHP_EOL

            . 'Country language code: fr' . PHP_EOL
            . 'Switzerland speaks same language with these countries: Belgium, Benin, Burkina Faso, Burundi,'
            . ' Cameroon, Canada, Central African Republic, Chad, Comoros, Congo, Congo (Democratic Republic of the),'
            . ' Djibouti, Equatorial Guinea, France, French Guiana, French Polynesia, French Southern Territories,'
            . ' Gabon, Guadeloupe, Guernsey, Guinea, Haiti, Holy See, Côte d\'Ivoire, Jersey, Lebanon, Luxembourg,'
            . ' Madagascar, Mali, Martinique, Mayotte, Monaco, New Caledonia, Niger, Réunion, Rwanda, Saint Barthélemy,'
            . ' Saint Martin (French part), Saint Pierre and Miquelon, Senegal, Seychelles, Togo, Vanuatu,'
            . ' Wallis and Futuna' . PHP_EOL

            . 'Country language code: it' . PHP_EOL
            . 'Switzerland speaks same language with these countries: Holy See, Italy, San Marino' . PHP_EOL
        );

        $this->languageGroupApplication->speak();
    }

    public function addInvalidInputProvider(): array
    {
        return [
            [
                [],
                'Invalid input length.' . PHP_EOL
            ],
            [
                ['Italy', 'San Marino', 'Switzerland'],
                'Invalid input length.' . PHP_EOL
            ],
            [
                ['Italy', '#$& Invalid Country Name'],
                'Country name can contain alphabets, special characters [Åôé()-,.\'] and space only.' . PHP_EOL
            ],
            [
                ['@#Invalid9Country&Name'],
                'Country name can contain alphabets, special characters [Åôé()-,.\'] and space only.' . PHP_EOL
            ],
        ];
    }

    /**
     * @dataProvider addInvalidInputProvider
     */
    public function testSpeakWithInvalidInput(array $invalidInputArgs, string $expectOutputString): void
    {
        $this->cliArgsService
            ->method('getArgs')
            ->willReturn($invalidInputArgs);

        $this->expectOutputString($expectOutputString);

        $this->languageGroupApplication->speak();
    }
}
