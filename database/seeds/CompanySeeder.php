<?php

use Illuminate\Database\Seeder;
use App\Company;


class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Enter authentication before getting Intrinio data
        $username = 'b7aac9b614877ef4b070cf462756d8bb';
        $password = 'ebdf24e3287a1962c941ae9076a3127c';

        $context = stream_context_create(array(
            'http' => array(
                'header' => "Authorization: Basic " . base64_encode("$username:$password")
            )
        ));

        //
        $json = file_get_contents("https://api.intrinio.com/companies", false, $context);
        $array = json_decode($json, JSON_PRETTY_PRINT);
        $loops = $array['total_pages'];

        // Request Intrino data 100 records at a time
        for ($i = 1; $i <= $loops; $i++) {
            $json = file_get_contents("https://api.intrinio.com/companies?page_number=" . "$i", false, $context);
            $array = json_decode($json, JSON_PRETTY_PRINT);
            $dataArray[] = $array['data'];
        }

        // Create Intrinio array with just tickers and names
        foreach ($dataArray as $value) {
            foreach ($value as $data) {
                $intrinioCompanies[] = ['ticker' => $data['ticker'], 'name' => $data['name']];
            }
        }

        // Pull all Quandle symbols, names, and codes
        function stockIndex($exchange)
        {
            if (($handle = fopen('https://s3.amazonaws.com/static.quandl.com/tickers/' . $exchange . '.csv', 'r')) === false) {
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
            $output = array_filter($output, function ($sub_arr) {
                foreach ($sub_arr as $item)
                    if ($item === "")
                        return false;
                return true;
            });

            return $output;
        }

        // Apply stockIndex function to each market
        $sp500 = stockIndex('SP500');
        $dowJones = stockIndex('dowjonesA');
        $nasdaqComposite = stockIndex('NASDAQComposite');
        $nasdaq100 = stockIndex('nasdaq100');
        $nyseComposite = stockIndex('NYSEComposite');
        $ftse100 = stockIndex('FTSE100');

        // Merge Quandl data into one array
        $quandlCompanies = array_merge($sp500, $dowJones, $nasdaqComposite, $nasdaq100, $nyseComposite, $ftse100);

        // Filter out Intrinio data that is not in Quandl data and add Quandl codes
        foreach ($intrinioCompanies as $intrinio) {
            foreach ($quandlCompanies as $quandl) {
                if ($intrinio['ticker'] == $quandl['ticker']) {
                    $masterList[] = [
                        'ticker' => $intrinio['ticker'],
                        'name' => $intrinio['name'],
                        'free_code' => $quandl['free_code'],
                    ];
                    break;
                }
            }
        }

        // Seed company table
        foreach ($masterList as $value) {
            Company::insert([
                'ticker' => $value['ticker'],
                'company_name' => $value['name'],
                'quandl_code' => $value['free_code'],
            ]);
        }
    }

}
