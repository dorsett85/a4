<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class ViewController extends StockController
{

    public function welcome()
    {

        return view('pages.welcome');

    }

    public function search()
    {

        $name = $this->request->has('name');

        return view('pages.search-companies')->with([
            'name' => $name
        ]);


    }

    public function searchResults()
    {
        // Validate form
        $this->errorMsgs();


        $name = $this->request->has('company');
        $array = $this->companyInfo();

        return view('pages.search-companies')->with([
            'array' => $array,
            'name' => $name,
        ]);

    }
}
