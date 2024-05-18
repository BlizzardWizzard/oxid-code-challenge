<?php

namespace currencyConverterTests\integration;

use currencyConverter\currencyConverters\JsonCurrencyConverter;
use currencyConverter\dataSources\JsonDataSource;
use PHPUnit\Framework\TestCase;

class JsonToJsonTest extends TestCase
{
    /**
     * @throws \JsonException
     */
    public function testJsonToJsonZeroBaseCurrency(): void
    {
        $dataSource = new JsonDataSource(file_get_contents('./data/testdata.json'));

        $converter = new JsonCurrencyConverter($dataSource);

        $convertedValues = $converter->convert(0, $dataSource->getBaseCurrency());

        $this->assertSame('{"EUR":0,"USD":0,"CHF":0,"CNY":0}', $convertedValues);
    }
}
