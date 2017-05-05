<?php

namespace App\Http\Controllers;

use App\Company;
use App\Favorite;
use App\Tag;
use Illuminate\Support\Facades\Input;
use Session;

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

        $allFavoritesTags = Favorite::getTagsForFavorites();

        return view('pages.favorites')->with([
            'favorites' => $favorites,
            'allFavoritesTags' => $allFavoritesTags,
        ]);

    }


    /*
     * Redirect to favorites after removing selected one from the list
     */
    public function removeCompany()
    {

        $company = Favorite::find($this->request->remove);
        $company->tags()->detach();
        $company->delete();

        Session::flash('message', $company->company_name . ' was removed from your favorites.');

        return redirect('/favorites');

    }


    /*
     * Page to select data
     */
    public function selectData()
    {

        // Check if old redirected value after updating tags exists
        $ticker = (is_null(Input::old('ticker'))) ? $this->request->ticker : Input::old('ticker');

        // Get model data for form input
        $companies = Company::all();
        $allFavorites = Favorite::with('tags')->get();

        $quandleCode = $companies->where('ticker', '=', $ticker)->first();

        // Get Quandl codes for favorites companies
        $favoriteDropdown = [];
        foreach ($allFavorites as $favorite) {
            foreach ($companies as $company) {
                if ($favorite->ticker == $company->ticker & $favorite->ticker != $quandleCode->ticker) {
                    $favoriteDropdown[] = ['company_name' => $favorite->company_name, 'quandl_code' => $company->quandl_code];
                }
            }
        }

        // Get array of tags for company and array of all tags
        $favorite = $allFavorites->where('ticker', '=', $ticker)->first();

        $tagsForThisCompany = [];
        foreach ($favorite->tags as $tag) {
            $tagsForThisCompany[] = $tag->name;
        }

        $tagsForCheckboxes = Tag::getTagsForCheckboxes();



        return view('pages.data')->with([
            'quandlCode' => $quandleCode->quandl_code,
            'company' => $favorite,
            'favoriteDropdown' => $favoriteDropdown,
            'tagsForCheckboxes' => $tagsForCheckboxes,
            'tagsForThisCompany' => $tagsForThisCompany,
        ]);

    }


    /*
     * Update tags and redirect to
     */
    public function updateTags()
    {

        $this->syncTags();

        return redirect('/data')->withInput();

    }

}
