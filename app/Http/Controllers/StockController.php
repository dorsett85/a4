<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Favorite;
use Session;
use Illuminate\Database\Eloquent\Collection;


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
     * Custom validation to check if user input matches a company from the companies table
     */
    public function validateCompany($attribute, $value, $parameters, $validator)
    {

        $match = Company::where('company_name', 'like', "%$value%")->first();

        if(is_null($match)) {
            return false;
        } else {
            return true;
        }

    }


    /*
     * Custom validation to check if user input company has already been added to their list
     */
    public function duplicateCompany($attribute, $value, $parameters, $validator)
    {

        $match = Favorite::where('company_name', '=', $value)->first();

        if(is_null($match)) {
            return true;
        } else {
            return false;
        }

    }


    /*
     * Validation function with custom errors
     */
    public function errorMsgs()
    {

        $errors = [
            'company' => 'required|min:3|company|duplicate',
        ];

        $errorMessages = [
            'company' => 'Your search did not return any results.',
            'duplicate' => $this->request->company . ' is already saved to your favorites list.'
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
        $ticker = Company::where('company_name', 'like', "%$name%")->first()->ticker;

        $five = Company::where('company_name', 'like', "%$name%")->orderBy('company_name')->get();

        // ***** LOOP OVER ALL COMPANIES THAT MATCH SEARCH AND GET DATA
        foreach ($five as $index => $item) {
            dump($item->ticker);
            if ($index > 3) {
                break;
            }
        }

        $data = file_get_contents("https://api.intrinio.com/companies?ticker=" . $ticker, false, $context);
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

        Session::flash('message', $this->request->company . ' was added.');

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

        $post = $this->request;
        $quandlCode = Company::where('ticker', '=', $post->ticker)->first()->quandl_code;

        return ['company' => $post->company, 'quandlCode' => $quandlCode, 'data' => $post->data];

    }


    /*
     * Delete company from user favorites table
     */
    public function deleteCompany()
    {
        $company = $this->request->remove;
        Favorite::where('company_name', '=', $company)->delete();

        Session::flash('message', $company . ' was removed.');

    }


}
