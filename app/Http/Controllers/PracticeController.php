<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Favorite;
use App\Tag;


class PracticeController extends Controller
{

    /*
     * Add individual companies
     */
    public function practice()
    {
        $favorite = Favorite::with('tags')->first();
        dump($favorite->tags);

    }

}
