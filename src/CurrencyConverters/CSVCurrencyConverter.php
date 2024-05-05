<?php

namespace currencyConverter\CurrencyConverters;

use currencyConverter\Currency\Currency;

class CSVCurrencyConverter extends BaseCurrencyConverter
{
    public function convert(float $amount, Currency $currency): string
    {
        // create a csv file
        $filename = uniqid('csv-currency-converter-', true) . '.csv';
        $file = fopen(sys_get_temp_dir() . $filename, 'wb');

        // write the calculated amounts to the file
        fputcsv($file, $this->calculateAmounts($amount, $currency));

        // get the file as a string
        $return = stream_get_contents($file);

        // close the file
        fclose($file);
        // delete the file
        unlink(sys_get_temp_dir() . $filename);

        // return csv string
        return $return;
    }
}