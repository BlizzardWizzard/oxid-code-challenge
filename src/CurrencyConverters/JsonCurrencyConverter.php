<?php

namespace currencyConverter\CurrencyConverters;

use currencyConverter\Currency\Currency;

class JsonCurrencyConverter extends BaseCurrencyConverter
{
    /**
     * @throws \JsonException
     */
    public function convert(float $amount, Currency $currency): string
    {
        // encode the calculated amounts in json & simply return that
        return json_encode($this->calculateAmounts($amount, $currency), JSON_THROW_ON_ERROR);
    }
}