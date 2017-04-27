<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;


class PracticeController extends Controller
{

    /*
     * Add individual companies
     */
    public function practice(Request $request)
    {
        dump($request->company);

    }

}
