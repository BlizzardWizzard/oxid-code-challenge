<?php

namespace currencyConverter\currencyConverters;

use currencyConverter\currency\Currency;

class CSVCurrencyConverter extends BaseCurrencyConverter
{
    /**
     * @inheritDoc
     */
    public function convert(float $amount, Currency $currency): string
    {
        // create a csv file
        $filename = uniqid('csv-currency-converter-', true) . '.csv';
        $file = fopen(sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename, 'w+b');

        // get the calculated amounts
        $calculatedAmounts = $this->calculateAmounts($amount, $currency);

        // write the calculated amounts to the file
        foreach ($calculatedAmounts as $key => $calculatedAmount) {
            fputcsv($file, [$key, $calculatedAmount]);
        }

        // reset the file pointer to the beginning of the file
        rewind($file);

        // get the file as a string
        $return = stream_get_contents($file);

        // close the file
        fclose($file);

        // delete the file
        unlink(sys_get_temp_dir() . DIRECTORY_SEPARATOR . $filename);

        // return csv string
        return $return;
    }
}