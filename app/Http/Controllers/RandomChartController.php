<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;


class RandomChartController extends Controller
{

    // Get random chart for ajax request
    public function randomChart()
    {

        $randomCompany = Company::get()->shuffle()->first();

        $randomCompany = [
            'name' => $randomCompany->company_name,
            'quandl_code' => $randomCompany->quandl_code
        ];

        dump($randomCompany);

    }

}
