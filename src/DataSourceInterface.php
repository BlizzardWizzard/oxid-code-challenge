<?php

interface DataSourceInterface
{
    /**
     * @return Currency[]
     */
    public function getCurrencies(): array;
}