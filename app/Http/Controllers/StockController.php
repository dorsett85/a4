<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Company;


class stockController extends Controller
{

    protected $request;


    /*
     * Get all request data during construct
     */
    public function __construct(Request $request)
    {

        $this->request = $request;

    }

    /*
     * Custom validation to check if user input matches a company from the autocomplete list
     */
    public function validateCompany($attribute, $value, $parameters, $validator)
    {

        foreach (Company::all() as $stock => $name) {
            $companyArray[$stock] = $name['company_name'];
        }
        if (empty($value)) {
            return true;
        }
        else {
            if (in_array($value, $companyArray)) {
                return true;
            } else {
                return false;
            }
        }
    }


    /*
     * Validation function with custom errors
     */
    public function errorMsgs()
    {

        $errors = [
            'company' => 'required|company',
        ];

        $errorMessages = [
            'company' => 'Invalid company, must select from the autocomplete menu',
        ];

        $this->validate($this->request, $errors, $errorMessages);

    }


    /*
     * Get Intrinio company info based on user selection
     */
    public function companyInfo()
    {

        // Set up Intrinio login information
        $username = 'b7aac9b614877ef4b070cf462756d8bb';
        $password = 'ebdf24e3287a1962c941ae9076a3127c';

        $context = stream_context_create(array(
            'http' => array(
                'header' => "Authorization: Basic " . base64_encode("$username:$password")
            )
        ));

        // Retrieve ticker from user selection and fetch company info
        $name = $this->request->input('company');
        $ticker = Company::where('company_name', '=', $name)->pluck('ticker');

        $data = file_get_contents("https://api.intrinio.com/companies?ticker=" . $ticker[0], false, $context);
        return json_decode($data, JSON_PRETTY_PRINT);

    }


    /*
     * Get company names, symbols, and Quandl calls
     */
    public function getStock(Request $request)
    {

        $company = $request->input('company');

        $quandlCode = Company::where('company_name', '=', $company)->pluck('quandl_code');

        return view('welcome', compact('quandlCode'));

        /*
        https://www.quandl.com/api/v3/datasets/WIKI/FB/data.csv?column_index[]=1&column_index[]=2&api_key=ZNUBmiZ3d-zMyLGBxyUt
        */

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
