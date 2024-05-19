<?php

namespace currencyConverterTests\integration;

use currencyConverter\currencyConverters\JsonCurrencyConverter;
use currencyConverter\dataSources\JsonDataSource;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class JsonToJsonTest extends TestCase
{
    /**
     * @return array
     */
    public static function convertProvider(): array
    {

        return [
            [
                0,
                '{"EUR":0,"USD":0,"CHF":0,"CNY":0}'
            ],
            [
                1,
                '{"EUR":1,"USD":5,"CHF":0.97,"CNY":2.3}'
            ],
            [
                2,
                '{"EUR":2,"USD":10,"CHF":1.94,"CNY":4.6}'
            ],
            [
                4,
                '{"EUR":4,"USD":20,"CHF":3.88,"CNY":9.2}'
            ],
            [
                8,
                '{"EUR":8,"USD":40,"CHF":7.76,"CNY":18.4}'
            ],
            [
                16,
                '{"EUR":16,"USD":80,"CHF":15.52,"CNY":36.8}'
            ],
            [
                32,
                '{"EUR":32,"USD":160,"CHF":31.04,"CNY":73.6}'
            ],
            [
                64,
                '{"EUR":64,"USD":320,"CHF":62.08,"CNY":147.2}'
            ],
            [
                128,
                '{"EUR":128,"USD":640,"CHF":124.16,"CNY":294.4}'
            ],
            [
                256,
                '{"EUR":256,"USD":1280,"CHF":248.32,"CNY":588.8}'
            ],
            [
                512,
                '{"EUR":512,"USD":2560,"CHF":496.64,"CNY":1177.6}'
            ],
            [
                0.5,
                '{"EUR":0.5,"USD":2.5,"CHF":0.485,"CNY":1.15}'
            ],
            [
                1.0,
                '{"EUR":1,"USD":5,"CHF":0.97,"CNY":2.3}'
            ],
            [
                1.5,
                '{"EUR":1.5,"USD":7.5,"CHF":1.455,"CNY":3.45}'
            ],
            [
                2.5,
                '{"EUR":2.5,"USD":12.5,"CHF":2.425,"CNY":5.75}'
            ],
            [
                5.0,
                '{"EUR":5,"USD":25,"CHF":4.85,"CNY":11.5}'
            ],
            [
                10.0,
                '{"EUR":10,"USD":50,"CHF":9.7,"CNY":23}'
            ]
        ];
    }

    /**
     * @throws \JsonException
     */
    #[DataProvider('convertProvider')]
    public function testJsonToJson($amount, $expected): void
    {
        $dataSource = new JsonDataSource(file_get_contents('./data/testdata.json'));

        $converter = new JsonCurrencyConverter($dataSource);

        $this->assertSame($expected, $converter->convert($amount, $dataSource->getBaseCurrency()));
    }
}
