<?php

namespace currencyConverter\currencyConverters;

use currencyConverter\currency\Currency;
use currencyConverter\dataSources\DataSourceInterface;

interface CurrencyConverterInterface
{
    public function __construct(DataSourceInterface $dataSource);

    public function convert(float $amount, Currency $currency): string;
}