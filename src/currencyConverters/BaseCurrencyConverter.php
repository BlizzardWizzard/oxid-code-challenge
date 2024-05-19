<?php

namespace currencyConverter\currencyConverters;

use currencyConverter\currency\Currency;
use currencyConverter\dataSources\DataSourceInterface;

abstract class BaseCurrencyConverter implements CurrencyConverterInterface
{
    private DataSourceInterface $dataSource;

    public function __construct(DataSourceInterface $dataSource)
    {
        $this->dataSource = $dataSource;
    }

    /**
     * @param float    $amount   the amount of currency
     * @param Currency $currency the currency we want to convert from
     *
     * @return float[] the resulting amount, indexed by their ISO4217 code.
     */
    final public function calculateAmounts(float $amount, Currency $currency): array
    {
        // factor for turning base amount into something we can use with integer operations
        // after multiplying with this factor, 0.0001 of a currency is 1.
        $factorForIntegerOperations = 100000;


        // convert to base currency amount
        $baseAmount = $currency->getExchangeRate() * $amount * $factorForIntegerOperations;

        $returnArr = [];
        foreach ($this->dataSource->getCurrencies() as $iso4217Code => $dataSourceCurrency) {
            // these should only be an integer operations, as the currency with the most decimal places has 4 decimal places
            $returnArr[$iso4217Code] = ($baseAmount * $dataSourceCurrency->getExchangeRate()) / $factorForIntegerOperations;
        }

        return $returnArr;
    }
}