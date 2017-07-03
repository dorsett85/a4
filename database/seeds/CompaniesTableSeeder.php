<?php

use Illuminate\Database\Seeder;
use App\Company;


class CompaniesTableSeeder extends Seeder
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

        // Get all Quandle tickers and codes
        $csv = array_map('str_getcsv', file("public/wiki_codes/wiki_codes.csv"));
        $headers = $csv[0];
        unset($csv[0]);
        $quandlCompanies = [];
        foreach ($csv as $row) {
            $newRow = [];
            foreach ($headers as $k => $key) {
                $newRow[$key] = $row[$k];
            }
            $quandlCompanies[] = $newRow;
        }

        // Filter out Intrinio data that is not in Quandl data and add Quandl codes
        $masterList = [];
        foreach ($intrinioCompanies as $intrinio) {
            foreach ($quandlCompanies as $quandl) {
                if ($intrinio['ticker'] == $quandl['ticker']) {
                    $masterList[] = [
                        'ticker' => $intrinio['ticker'],
                        'name' => $intrinio['name'],
                        'quandl_code' => $quandl['quandl_code'],
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
                'quandl_code' => $value['quandl_code'],
            ]);
        }
    }

}
