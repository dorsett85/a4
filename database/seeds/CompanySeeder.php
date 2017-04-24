<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\Http\Controllers\StockController;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Function to grab names, symbols and Quandl calls
        function stockIndex($market) {
            if (($handle = fopen('https://s3.amazonaws.com/static.quandl.com/tickers/' . $market . '.csv', 'r')) === false) {
                die('Error opening file');
            }

            $headers = fgetcsv($handle, 1000);
            $output = array();

            while ($row = fgetcsv($handle, 1000)) {
                $output[] = array_combine($headers, $row);
            }

            fclose($handle);

            // Remove premium_code row
            foreach ($output as $key => $value) {
                unset($value['premium_code']);
            }

            // Remove incomplete rows
            $output = array_filter($output, function($sub_arr) {
                foreach ($sub_arr as $item)
                    if ($item === "")
                        return false;
                return true;
            });

            return $output;
        }

        // Apply function to each market
        $sp500 = stockIndex('SP500');
        $dowJones = stockIndex('dowjonesA');
        $nasdaqComposite = stockIndex('NASDAQComposite');
        $nasdaq100 = stockIndex('nasdaq100');
        $nyseComposite = stockIndex('NYSEComposite');
        $ftse100 = stockIndex('FTSE100');

        // Merge data into one array
        $companies = array_merge($sp500, $dowJones, $nasdaqComposite, $nasdaq100, $nyseComposite, $ftse100);

        // Seed company table
        foreach ($companies as $value) {
            Company::insert([
                'ticker' => $value['ticker'],
                'company_name' => $value['name'],
                'quandl_code' => $value['free_code'],
            ]);
        }
    }

}
