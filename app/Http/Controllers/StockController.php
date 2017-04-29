<?php

namespace App\Http\Controllers;

use App\Favorite;
use Illuminate\Http\Request;
use App\Company;
use Session;


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
     * Function to check if post data is submitted and leave it blank if it's not
     */
    public function isPosted($value)
    {
        return $this->request->has($value) ? $this->request->$value : '';
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
        } else {
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
        $name = $this->request->company;
        $ticker = Company::where('company_name', '=', $name)->pluck('ticker');

        $data = file_get_contents("https://api.intrinio.com/companies?ticker=" . $ticker[0], false, $context);
        $companyInfo = json_decode($data, JSON_PRETTY_PRINT);

        // Check if values are empty and leave blank if they are
        function isEmpty($value)
        {
            return (!empty($value)) ? $value : 'Information unavailable';
        }

        $companyInfo = [
            'company' => isEmpty($companyInfo['name']),
            'ticker' => isEmpty($companyInfo['ticker']),
            'stock_exchange' => isEmpty($companyInfo['stock_exchange']),
            'company_url' => isEmpty($companyInfo['company_url']),
            'hq_state' => isEmpty($companyInfo['hq_state']),
            'sector' => isEmpty($companyInfo['sector']),
            'industry_category' => isEmpty($companyInfo['industry_category']),
            'industry_group' => isEmpty($companyInfo['industry_group']),
            'short_description' => isEmpty($companyInfo['short_description'])
        ];

        return $companyInfo;

    }


    /*
     * Add search result to favorites table
     */
    public function addFavorite()
    {

        $favorite = new Favorite;
        $favorite->ticker = $this->request->input('ticker');
        $favorite->company_name = $this->request->input('company');
        $favorite->stock_exchange = $this->request->input('stock_exchange');
        $favorite->short_description = $this->request->input('short_description');
        $favorite->company_url = $this->request->input('company_url');
        $favorite->hq_state = $this->request->input('hq_state');
        $favorite->sector = $this->request->input('sector');
        $favorite->industry_category = $this->request->input('industry_category');
        $favorite->industry_group = $this->request->input('industry_group');
        $favorite->save();

        Session::flash('message', 'The company ' . $this->request->company . ' was added.');

    }

    /*
     * Get user favorites table
     */
    public function getFavorites()
    {

        $favorites = Favorite::all();

        return $favorites;
    }


    /*
     * Get company names, symbols, and Quandl calls
     */
    public function dataSelect()
    {
        $company = $this->request->company;
        $symbol = $this->request->symbol;
        $ticker = Company::where('ticker', '=', $symbol)->pluck('quandl_code');

        return ['company' => $company, 'ticker' => $ticker[0]];

    }


    /*
     * Delete company from user favorites table
     */
    public function deleteCompany()
    {
        $company = $this->request->remove;
        Favorite::where('company_name', '=', $company)->delete();

        Session::flash('message', 'The company ' . $company . ' was Removed.');

    }


}
