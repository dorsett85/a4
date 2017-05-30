<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Company;
use App\Favorite;
use Session;
use Auth;


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
     * Get sample company information to display on landing page
     */
    public function landingInfo()
    {

        // Set up Intrinio login information
        $username = 'b7aac9b614877ef4b070cf462756d8bb';
        $password = 'ebdf24e3287a1962c941ae9076a3127c';

        $context = stream_context_create(array(
            'http' => array(
                'header' => "Authorization: Basic " . base64_encode("$username:$password")
            )
        ));

        // Function to check if search return fields are empty and leave blank if they are
        function isEmpty($value)
        {
            return (!empty($value)) ? $value : 'Information unavailable';
        }

        // Get 3 random companies
        $landingRandom = Company::pluck('ticker')->shuffle()->toArray();
        $sampleStocks = array_slice($landingRandom, 0, 3);

        $landingInfo = [];

        foreach ($sampleStocks as $item) {
            $data = file_get_contents("https://api.intrinio.com/companies?ticker=" . $item, false, $context);
            $json = json_decode($data, JSON_PRETTY_PRINT);

            $landingInfo[$item] = [
                'company' => isEmpty($json['name']),
                'ticker' => isEmpty($json['ticker']),
                'stock_exchange' => isEmpty($json['stock_exchange']),
                'company_url' => isEmpty($json['company_url']),
                'hq_state' => isEmpty($json['hq_state']),
                'sector' => isEmpty($json['sector']),
                'industry_category' => isEmpty($json['industry_category']),
                'industry_group' => isEmpty($json['industry_group']),
                'short_description' => isEmpty($json['short_description']),
            ];
        }

        return $landingInfo;

    }


    /*
     * Get random chart info
     */
    public function randomChart()
    {

        $randomCompany = Company::get()->shuffle()->first();

        $randomCompany = [
            'name' => $randomCompany->company_name,
            'quandl_code' => $randomCompany->quandl_code
        ];

        return response()->json(array('randomCompany' => $randomCompany));

    }


    /*
     * Custom validation to check if user input matches a company from the companies table
     */
    public function validateCompany($attribute, $value, $parameters, $validator)
    {

        $match = Company::where('company_name', 'like', "%$value%")->first();

        if (is_null($match)) {
            return false;
        } else {
            return true;
        }

    }


    /*
     * Validation function with custom errors
     */
    public function errorMsgs()
    {

        $errors = [
            'searchTerm' => 'required|min:3|company',
        ];

        $errorMessages = [
            'company' => 'Your search did not return any results.',
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

        // Get search term and have the function return null if value is null
        $name = ($this->request->has('searchTerm')) ? $this->request->searchTerm : Input::old('searchTerm');

        if (is_null($name)) {
            return null;
        }

        // Match search term to the companies table
        $matches = Company::where('company_name', 'like', "%$name%")->orderBy('company_name')->get();

        // Retrieve favorites table to compare if company in search results has already been added
        // If it has, change 'Add to Favorites' button
        $favorites = Auth::user()->favorites()->pluck('ticker')->toArray();

        // Function to check if search return fields are empty and leave blank if they are
        function isEmpty($value)
        {
            return (!empty($value)) ? $value : 'Information unavailable';
        }

        $companyInfo = [];

        // Loop over companies that match search and get data
        foreach ($matches as $index => $item) {

            // Stop loop after 5 returns
            if ($index > 4) {
                break;
            }

            $data = file_get_contents("https://api.intrinio.com/companies?ticker=" . $item->ticker, false, $context);
            $json = json_decode($data, JSON_PRETTY_PRINT);

            $companyInfo[$index] = [
                'company' => isEmpty($json['name']),
                'ticker' => isEmpty($json['ticker']),
                'stock_exchange' => isEmpty($json['stock_exchange']),
                'company_url' => isEmpty($json['company_url']),
                'hq_state' => isEmpty($json['hq_state']),
                'sector' => isEmpty($json['sector']),
                'industry_category' => isEmpty($json['industry_category']),
                'industry_group' => isEmpty($json['industry_group']),
                'short_description' => isEmpty($json['short_description']),
                'duplicate' => in_array($item->ticker, $favorites) ? 'yes' : '',
            ];
        }

        return $companyInfo;

    }


    /*
     * Add search result to favorites table
     */
    public function addFavorite()
    {

        $favorite = new Favorite;
        $favorite->ticker = $this->request->ticker;
        $favorite->company_name = $this->request->company;
        $favorite->stock_exchange = $this->request->stock_exchange;
        $favorite->short_description = $this->request->short_description;
        $favorite->company_url = $this->request->company_url;
        $favorite->hq_state = $this->request->hq_state;
        $favorite->sector = $this->request->sector;
        $favorite->industry_category = $this->request->industry_category;
        $favorite->industry_group = $this->request->industry_group;
        $favorite->user_id = $this->request->user()->id;
        $favorite->save();

        Session::flash('message', $this->request->company . ' was added to your favorites.');

    }


    /*
     * Add/remove tags from tags table
     */
    public function syncTags()
    {

        $company = Auth::user()->favorites()->find($this->request->id);
        $tags = ($this->request->tags) ?: [];

        $company->tags()->sync($tags);
        $company->save();

    }
}
