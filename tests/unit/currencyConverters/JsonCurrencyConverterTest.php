<?php

namespace currencyConverterTests\unit\currencyConverters;

use currencyConverter\currencyConverters\JsonCurrencyConverter;
use currencyConverter\dataSources\JsonDataSource;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class JsonCurrencyConverterTest extends TestCase
{
    /**
     * @throws \JsonException
     */
    public static function jsonDataProvider(): array
    {
        return [[new JsonDataSource(file_get_contents('./../../data/testdata.json'))]];
    }

    public static function convertProvider(): array
    {
        $datasource = new JsonDataSource(file_get_contents('./../../data/testdata.json'));

        return [
            [
                0,
                $datasource,
                '' //TODO actually write out the expected result
            ]
            //TODO add more cases
        ];
    }

    #[DataProvider('jsonDataProvider')]
    public function test__construct(JsonDataSource $dataSource): void
    {

        $obj = new JsonCurrencyConverter($dataSource);

        $this->assertInstanceOf(JsonCurrencyConverter::class, $obj);
    }

    /**
     * @throws \JsonException
     */
    #[DataProvider('convertProvider')]
    public function testConvert($amount, $dataSource, $expected): void
    {
        $this->assertSame($expected, (new JsonCurrencyConverter($dataSource))->convert($amount, $dataSource->getBaseCurrency()));
    }
}
