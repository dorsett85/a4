<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends StockController
{

    public function welcome() {
        dump($this->companies[0]);

        return view('welcome');
    }

    public function submit(Request $request) {
        dump($this->getStock());
    }
}
