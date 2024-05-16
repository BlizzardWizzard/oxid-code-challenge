<?php

namespace currencyConverter\currencyConverters;

use currencyConverter\currency\Currency;
use currencyConverter\dataSources\DataSourceInterface;

interface CurrencyConverterInterface
{
    public function __construct(DataSourceInterface $dataSource);

    /**
     * @param float                                $amount   the amount to convert
     * @param \currencyConverter\currency\Currency $currency the currency to convert from
     *
     * @return string
     */
    public function convert(float $amount, Currency $currency): string;
}