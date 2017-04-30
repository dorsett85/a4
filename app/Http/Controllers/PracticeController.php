<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Favorite;


class PracticeController extends Controller
{

    /*
     * Add individual companies
     */
    public function practice(Request $request)
    {
        dump(Favorite::where('company_name', '=', $request->company)->pluck('company_name'));

    }

}
