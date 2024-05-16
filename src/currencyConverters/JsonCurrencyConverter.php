<?php

namespace currencyConverter\currencyConverters;

use currencyConverter\currency\Currency;

class JsonCurrencyConverter extends BaseCurrencyConverter
{
    /**
     * @inheritDoc
     * @throws \JsonException
     */
    public function convert(float $amount, Currency $currency): string
    {
        // encode the calculated amounts in json & simply return that
        return json_encode($this->calculateAmounts($amount, $currency), JSON_THROW_ON_ERROR);
    }
}