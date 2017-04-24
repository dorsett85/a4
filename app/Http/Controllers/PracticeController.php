<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;


class PracticeController extends Controller
{

    /*
     * Add individual companies
     */
    public function practice() {

        # Instantiate a new Book Model object
        $company = new Company();

        # Set the parameters
        # Note how each parameter corresponds to a field in the table
        $company->ticker = "GOOG";
        $company->company_name = 'Google Inc.';
        $company->quandl_code = 'WIKI/GOOG';

        # Invoke the Eloquent `save` method to generate a new row in the
        # `books` table, with the above data
        $company->save();

        dump('Added: ' . $company->ticker);
    }


}
