<?php

namespace currencyConverterTests;

use currencyConverter\Currency\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{
    public function testCurrency(): void
    {
        $code = 'EUR';
        $exchangeRate = 1;

        $currency = new Currency($code, $exchangeRate);

        $this->assertEquals($code, $currency->getIso4217Code());
        $this->assertEquals($exchangeRate, $currency->getExchangeRate());
    }
}
