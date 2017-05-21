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

        $favoritesList = Favorite::orderBy('company_name')->get();

        return view('pages.welcome')->with([
            'favoritesList' => $favoritesList
        ]);

    }


    /*
     * Page to search companies
     */
    public function search()
    {

        if (Session::has('errors')) {
            $searchResults = null;
            $searchTerm = null;
        } else {
            $searchTerm = Input::old('searchTerm');
            $searchResults = $this->companyInfo();
        }

        $favoritesList = Favorite::orderBy('company_name')->get();

        return view('pages.search')->with([
            'favoritesList' => $favoritesList,
            'searchTerm' => $searchTerm,
            'searchResults' => $searchResults
        ]);

    }


    /*
     * Page to view search results
     */
    public function searchResults()
    {

        // Validate form
        $this->errorMsgs();

        $searchTerm = $this->request->has('searchTerm') ? $this->request->searchTerm : '';
        $searchResults = $this->companyInfo();

        $favoritesList = Favorite::orderBy('company_name')->get();

        return view('pages.search')->with([
            'favoritesList' => $favoritesList,
            'searchResults' => $searchResults,
            'searchTerm' => $searchTerm
        ]);

    }


    /*
     * Redirect to search page after adding book
     */
    public function saveFavorite()
    {

        $this->addFavorite();

        return redirect('/search')->withInput();

    }


    /*
     * Page to show favorite companies
     */
    public function showFavorites()
    {

        $favorites = Favorite::orderBy('company_name')->get();

        $allFavoritesTags = Favorite::getTagsForFavorites();

        return view('pages.favorites')->with([
            'favoritesList' => $favorites,
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

        $ticker = $this->request->ticker;
        $data = 'set';

        // Get array of tags for company and array of all tags
        $favoritesList = Favorite::orderBy('company_name')->where('ticker', '!=', $ticker)->get();
        $favorite = Favorite::with('tags')->where('ticker', '=', $ticker)->first();

        $tagsForThisCompany = [];
        foreach ($favorite->tags as $tag) {
            $tagsForThisCompany[] = $tag->name;
        }

        $tagsForCheckboxes = Tag::getTagsForCheckboxes();

        $quandleCode = Company::where('ticker', '=', $ticker)->first();

        return view('pages.data')->with([
            'quandlCode' => $quandleCode->quandl_code,
            'favoritesList' => $favoritesList,
            'company' => $favorite,
            'tagsForCheckboxes' => $tagsForCheckboxes,
            'tagsForThisCompany' => $tagsForThisCompany,
            'data' => $data
        ]);

    }


    /*
     * Update tags and redirect to data view page
     */
    public function updateTags()
    {

        $this->syncTags();
        $ticker = $this->request->ticker;

        return redirect('/data/' . $ticker);

    }

}
