<?php

namespace currencyConverter\CurrencyConverters;

use currencyConverter\Currency\Currency;
use currencyConverter\DataSources\DataSourceInterface;

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
    protected function calculateAmounts(float $amount, Currency $currency): array
    {
        // convert to base currency amount
        $baseAmount = $currency->getExchangeRate() * $amount;

        $returnArr = [];
        foreach ($this->dataSource->getCurrencies() as $iso4217Code => $dataSourceCurrency) {
            $returnArr[$iso4217Code] = $baseAmount * $dataSourceCurrency->getExchangeRate();
        }

        return $returnArr;
    }
}