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
        // after multiplying with this factor, 0.000001 of a currency is 1.
        // unless someone tries to convert something bigger than 9E12, we're probably not going to run into the integer limit.
        $factorForIntegerOperations = 100000;


        // multiply by $factorForIntegerOperations and convert to base currency amount
        $baseAmount = ($amount * $factorForIntegerOperations) / $currency->getExchangeRate();

        $returnArr = [];
        foreach ($this->dataSource->getCurrencies() as $iso4217Code => $dataSourceCurrency) {
            // multiply the base amount times the exchange rate of $dataSourceCurrency, then divide by $factorForIntegerOperations, so we get the actual number.
            $returnArr[$iso4217Code] = ($baseAmount * $dataSourceCurrency->getExchangeRate()) / $factorForIntegerOperations;
        }

        return $returnArr;
    }
}