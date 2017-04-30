<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class ViewController extends StockController
{

    /*
     * Landing page
     */
    public function welcome()
    {

        return view('pages.welcome');

    }


    /*
     * Page to search companies
     */
    public function search()
    {

        $company = $this->isPosted('company');

        return view('pages.search')->with([
            'company' => $company
        ]);


    }


    /*
     * Page to view search results
     */
    public function searchResults()
    {
        // Validate form
        $this->errorMsgs();

        $company = $this->isPosted('company');
        $infoArray = $this->companyInfo();

        return view('pages.search')->with([
            'infoArray' => $infoArray,
            'company' => $company
        ]);

    }


    /*
     * Redirect to search page after adding book
     */
    public function saveFavorite()
    {
        $this->addFavorite();

        return redirect('/search');

    }


    /*
     * Page to show favorite companies
     */
    public function showFavorites()
    {

        $favorites = $this->getFavorites();

        return view('pages.favorites')->with([
            'favorites' => $favorites
        ]);
    }


    /*
     * Page to select data
     */
    public function selectData()
    {

        $company = $this->dataSelect();

        return view('pages.data')->with([
            'company' => $company
        ]);
    }


    /*
     * Redirect to favorites after removing selected one from the list
     */
    public function removeCompany()
    {

        $this->deleteCompany();
        $favorites = $this->getFavorites();

        return redirect('/favorites');

    }


}
