<?php

namespace currencyConverterTests\unit\dataSources;

use currencyConverter\currency\Currency;
use currencyConverter\dataSources\JsonDataSource;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class JsonDataSourceTest extends TestCase
{
    public static function jsonDataProvider(): array
    {
        return [
            [file_get_contents('./data/testdata.json')]
        ];
    }

    public static function badJsonDataProvider(): array
    {
        return [
            [file_get_contents('./data/badtestdata.json')]
        ];
    }

    /**
     * @throws \JsonException
     */
    #[DataProvider('jsonDataProvider')]
    public function testConstruct(string $testData): void
    {
        // check if constructor constructs things
        $this->assertInstanceOf(JsonDataSource::class, new JsonDataSource($testData));
    }

    /**
     * @throws \JsonException
     */
    #[DataProvider('badJsonDataProvider')]
    public function testConstructWithBadData(string $badData): void
    {
        // check if constructor doesn't construct things when it shouldn't
        $this->expectException(RuntimeException::class);

        new JsonDataSource($badData);
    }

    /**
     * @throws \JsonException
     */
    #[DataProvider('jsonDataProvider')]
    public function testJsonDataSource(string $testData): void
    {
        // decode test data
        $decodedJson = json_decode($testData, true, 512, JSON_THROW_ON_ERROR);


        // create new JsonDataSource
        $dataSource = new JsonDataSource($testData);

        // do we have a base currency?
        $this->assertEquals(new Currency($decodedJson['baseCurrency'], 1), $dataSource->getBaseCurrency());

        // get all currencies
        $currencies = $dataSource->getCurrencies();

        // is this an array?
        $this->assertIsArray($currencies);

        // is this array the right length?
        $this->assertCount(count($decodedJson['exchangeRates']), $currencies);

        // check that all the currencies have the right code/exchange rate combination
        foreach ($currencies as $code => $currency) {
            $this->assertSame($code, $currency->getIso4217Code());

            $this->assertSame((float)$decodedJson['exchangeRates'][$currency->getIso4217Code()], $currency->getExchangeRate());
        }
    }
}
