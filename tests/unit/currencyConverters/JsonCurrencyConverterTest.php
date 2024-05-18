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
        return [[new JsonDataSource(file_get_contents('./data/testdata.json'))]];
    }

    /**
     * @throws \JsonException
     */
    public static function convertProvider(): array
    {
        $datasource = new JsonDataSource(file_get_contents('./data/testdata.json'));

        return [
            [
                0,
                $datasource,
                '{"EUR":0,"USD":0,"CHF":0,"CNY":0}'
            ],
            [
                1,
                $datasource,
                '{"EUR":1,"USD":5,"CHF":0.97,"CNY":2.3}'
            ],
            [
                2,
                $datasource,
                '{"EUR":2,"USD":10,"CHF":1.94,"CNY":4.6}'
            ],
            [
                4,
                $datasource,
                '{"EUR":4,"USD":20,"CHF":3.88,"CNY":9.2}'
            ],
            [
                8,
                $datasource,
                '{"EUR":8,"USD":40,"CHF":7.76,"CNY":18.4}'
            ],
            [
                16,
                $datasource,
                '{"EUR":16,"USD":80,"CHF":15.52,"CNY":36.8}'
            ],
            [
                32,
                $datasource,
                '{"EUR":32,"USD":160,"CHF":31.04,"CNY":73.6}'
            ],
            [
                64,
                $datasource,
                '{"EUR":64,"USD":320,"CHF":62.08,"CNY":147.2}'
            ],
            [
                128,
                $datasource,
                '{"EUR":128,"USD":640,"CHF":124.16,"CNY":294.4}'
            ],
            [
                256,
                $datasource,
                '{"EUR":256,"USD":1280,"CHF":248.32,"CNY":588.8}'
            ],
            [
                512,
                $datasource,
                '{"EUR":512,"USD":2560,"CHF":496.64,"CNY":1177.6}'
            ],
            [
                0.5,
                $datasource,
                '{"EUR":0.5,"USD":2.5,"CHF":0.485,"CNY":1.15}'
            ],
            [
                1.0,
                $datasource,
                '{"EUR":1,"USD":5,"CHF":0.97,"CNY":2.3}'
            ],
            [
                1.5,
                $datasource,
                '{"EUR":1.5,"USD":7.5,"CHF":1.455,"CNY":3.45}'
            ],
            [
                2.5,
                $datasource,
                '{"EUR":2.5,"USD":12.5,"CHF":2.425,"CNY":5.75}'
            ],
            [
                5.0,
                $datasource,
                '{"EUR":5,"USD":25,"CHF":4.85,"CNY":11.5}'
            ],
            [
                10.0,
                $datasource,
                '{"EUR":10,"USD":50,"CHF":9.7,"CNY":23}'
            ]
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
