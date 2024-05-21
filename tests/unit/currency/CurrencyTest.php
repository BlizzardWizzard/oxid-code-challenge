<?php

namespace currencyConverterTests\unit\currency;

use currencyConverter\currency\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function testCurrency(): void
    {
        // create test data
        $code = 'EUR';
        $exchangeRate = 1;

        // create currency with that test data
        $currency = new Currency($code, $exchangeRate);

        // is the code right?
        $this->assertEquals($code, $currency->getIso4217Code());
        // is the exchange rate right?
        $this->assertEquals($exchangeRate, $currency->getExchangeRate());
    }
}
