<?php

namespace currencyConverter\dataSources;

use currencyConverter\currency\Currency;

interface DataSourceInterface
{
    public function __construct(string $data);

    /**
     * returns an array of currencies, indexed by their ISO4217 code.
     * @return Currency[]
     */
    public function getCurrencies(): array;

    /**
     * returns the base currency of this data source.
     * @return \currencyConverter\currency\Currency
     */
    public function getBaseCurrency(): Currency;
}