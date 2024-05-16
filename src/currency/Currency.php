<?php

namespace currencyConverter\currency;

class Currency
{
    private string $code;
    private float  $exchangeRate;

    /**
     * @param string $code
     * @param float  $exchangeRate
     */
    public function __construct(string $code, float $exchangeRate) {
        $this->code = $code;
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @return string the ISO 4217 code of the currency
     */
    public  function getIso4217Code(): string
    {
        return $this->code;
    }

    /**
     * @return float factor of the exchange rate
     */
    public function getExchangeRate(): float
    {
        return $this->exchangeRate;
    }
}