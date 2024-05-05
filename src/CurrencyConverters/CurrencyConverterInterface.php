<?php

namespace currencyConverter\CurrencyConverters;

use currencyConverter\Currency\Currency;
use currencyConverter\DataSources\DataSourceInterface;

interface CurrencyConverterInterface
{
    public function __construct(DataSourceInterface $dataSource);

    public function convert(float $amount, Currency $currency): string;
}