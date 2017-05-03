<?php

namespace App\Http\Controllers;

use App\Company;
use App\Favorite;
use App\Tag;

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
        dump(old('company', ''));

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
        $searchResults = $this->companyInfo();

        return view('pages.search')->with([
            'searchResults' => $searchResults,
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

        $favorites = Favorite::orderBy('company_name')->get();

        return view('pages.favorites')->with([
            'favorites' => $favorites
        ]);

    }


    /*
     * Page to select data
     */
    public function selectData()
    {

        $quandlCode = Company::where('ticker', '=', $this->request->ticker)->first();

        $favoriteTags = Favorite::with('tags')->where('ticker', '=', $this->request->ticker)->first();
        dump($favoriteTags->tags->isEmpty());

        $tags = Tag::get();
        foreach ($tags as $tagName) {
            dump($tagName['name']);
        }

        return view('pages.data')->with([
            'quandlCode' => $quandlCode->quandl_code,
            'company' => $this->request,
            'tags' => $tags,
        ]);

    }


    /*
     * Redirect to favorites after removing selected one from the list
     */
    public function removeCompany()
    {

        $company = $this->request->remove;
        Favorite::where('company_name', '=', $company)->delete();
        Session::flash('message', $company . ' was removed from your favorites.');

        return redirect('/favorites');

    }


}
