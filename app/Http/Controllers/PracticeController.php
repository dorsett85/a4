<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Favorite;
use App\Tag;


class PracticeController extends Controller
{

    /*
     * Add individual companies
     */
    public function practice()
    {

        $csv = array_map('str_getcsv', file("wiki_codes/wiki_codes.csv"));
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
        foreach ($quandlCompanies as $quandl) {
            dump($quandl["quandl_code"]);
        }

        # dump($quandlCompanies);
    }

}
