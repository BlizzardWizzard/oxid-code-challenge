<?php

namespace currencyConverter\DataSources;
use currencyConverter\Currency\Currency;

interface DataSourceInterface
{
    public function __construct(string $data);

    /**
     * returns an array of currencies, indexed by their ISO4217 code.
     * @return Currency[]
     */
    public function getCurrencies(): array;

    /**
     * @return \currencyConverter\Currency\Currency
     */
    public function getBaseCurrency(): Currency;
}