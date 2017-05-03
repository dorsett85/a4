<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Company;
use App\Favorite;
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
     * Validation function with custom errors
     */
    public function errorMsgs()
    {

        $errors = [
            'company' => 'required|min:3|company',
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

        // Retrieve ticker from user selection and fetch company info
        $name = $this->request->company;
        $matches = Company::where('company_name', 'like', "%$name%")->orderBy('company_name')->get();

        // Retrieve favorites table to compare if company in search results has already been added
        // If it has, change 'Add to Favorites' button
        $favorites = Favorite::pluck('company_name')->toArray();

        // Function to check if search return fields are empty and leave blank if they are
        function isEmpty($value)
        {
            return (!empty($value)) ? $value : 'Information unavailable';
        }

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
                'duplicate' =>  in_array($item->company_name, $favorites) ? 'yes' : '',
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

        Session::flash('message', $this->request->company . ' was added to your favorites.');

    }


}
