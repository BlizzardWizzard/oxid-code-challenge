<?php

interface DataSourceInterface
{
    public function __construct(string $data);

    /**
     * @return Currency[]
     */
    public function getCurrencies(): array;

    /**
     * @return \Currency
     */
    public function getBaseCurrency(): Currency;
}