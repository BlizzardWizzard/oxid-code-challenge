<?php

class JsonDataSource implements DataSourceInterface
{
    private string $baseCurrencyCode;
    private ?Currency $baseCurrency = null;
    private string $exchangeRates;
    private array $currencies = [];

    /**
     * @param string $data
     *
     * @throws \JsonException
     */
    public function __construct(string $data)
    {
        // is this even valid json?
        if (!json_validate($data)) {
            throw new RuntimeException('Invalid json data');
        }

        // decode json to an associative array
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        // do we have a base currency?
        if (!isset($data['baseCurrency'])) {
            throw new RuntimeException('Data does not contain base currency');
        }

        // is the base currency a string?
        if (!is_string($data['baseCurrency'])) {
            throw new RuntimeException('Base currency code is not a string');
        }
        // set the base currency
        $this->baseCurrencyCode = $data['baseCurrency'];

        // do we have exchange rates?
        if (!isset($data['exchangeRates'])) {
            throw new RuntimeException('Data does not contain exchange rates');
        }

        // validate exchange rates
        foreach ($data['exchangeRates'] as $key => $exchangeRate) {

            // does the code fit the 3-letter schema?
            if (!is_string($key) || strlen($key) !== 3) {
                throw new RuntimeException('Invalid currency code "' . $key . '"');
            }
            // is our exchange rate a number?
            if (!is_int($exchangeRate) && !is_float($exchangeRate)) {
                throw new RuntimeException('Invalid exchange rate factor "' . $exchangeRate . '"');
            }
        }
        $this->exchangeRates = $data['exchangeRates'];
    }

    /**
     * @inheritDoc
     */
    public function getCurrencies(): array
    {
        if (count($this->currencies) === 0) {
            $return = [];
            foreach ($this->exchangeRates as $code => $exchangeRate) {
                $return[] = new Currency($code, $exchangeRate);
            }

            $this->currencies = $return;
        }

        return $this->currencies;
    }

    /**
     * @inheritDoc
     */
    public function getBaseCurrency(): Currency
    {
        if ($this->baseCurrency === null) {
            $this->baseCurrency = new Currency($this->baseCurrencyCode, 1);
        }

        return $this->baseCurrency;
    }
}