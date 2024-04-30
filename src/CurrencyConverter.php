<?php

class CurrencyConverter
{
    /**
     * @param float     $amount the amount of base currency
     * @param \Currency $currency the currency we want to convert to
     *
     * @return float the resulting amount
     */
    public function convert(float $amount, Currency $currency): float
    {
        return $amount * $currency->exchangeRate();
    }
}