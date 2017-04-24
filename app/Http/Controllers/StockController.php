<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class stockController extends Controller
{

        /*
         * Get company names, symbols, and Quandl calls
         */
        public function getStock(Request $request) {

            $company = $request->input('company');

            $quandlCode = Company::where('company_name', '=', $company)->pluck('quandl_code');
            return $quandlCode[0];

            /*
            $handle = file_get_contents("https://www.quandl.com/api/v3/datasets/" . $quandlCode[0] . "/data.json?api_key=ZNUBmiZ3d-zMyLGBxyUt");
            $json = json_decode($handle, true);

            foreach($json as $item => $value) {
                foreach ($value['data'] as $key => $close) {
                    dump($close[0] . ' ' . $close[4]);
                }
            }
            */
            # json_encode($array);
    }


}
