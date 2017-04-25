<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends StockController
{

    public function welcome() {
        dump($this->dbQuery());

        return view('pages.welcome');
    }

    public function searchResult() {
        $this->getStock();
    }
}
