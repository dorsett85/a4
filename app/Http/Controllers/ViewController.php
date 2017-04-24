<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends StockController
{

    public function welcome() {
        dump($this->dbQuery());

        return view('welcome');
    }

    public function postCompany(Request $request) {
        dump($this->companyInfo());
    }
}
