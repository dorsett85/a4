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

        if (empty(Input::old('searchTerm'))) {
            $searchResults = null;
            $searchTerm = null;
        } else {
            $searchTerm = Input::old('searchTerm');
            $searchResults = $this->companyInfo();
        }

        return view('pages.search')->with([
            //'searchResults' => $searchResults,
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

        return view('pages.search')->with([
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

        // Remove session ticker variable for when user goes back to data view
        Session::pull('ticker');

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

        // Add session variables if they don't exist
        if (Session::has('ticker')) {
            $ticker = Session::get('ticker', $this->request->ticker);
        } else {
            Session::push('ticker', $this->request->ticker);
            $ticker = Session::get('ticker', $this->request->ticker);
        }

        if (Session::has('data')) {
            $data = Session::get('data', $this->request->data);
        } else {
            Session::push('data', $this->request->data);
            $data = Session::get('data', $this->request->data);
        }

        // Get array of tags for company and array of all tags
        $favorite = Favorite::with('tags')->where('ticker', '=', $ticker)->first();

        $tagsForThisCompany = [];
        foreach ($favorite->tags as $tag) {
            $tagsForThisCompany[] = $tag->name;
        }

        $tagsForCheckboxes = Tag::getTagsForCheckboxes();

        $quandleCode = Company::where('ticker', '=', $ticker)->first();

        return view('pages.data')->with([
            'quandlCode' => $quandleCode->quandl_code,
            'company' => $favorite,
            'tagsForCheckboxes' => $tagsForCheckboxes,
            'tagsForThisCompany' => $tagsForThisCompany,
            'data' => $data
        ]);

    }


    /*
     * Update tags and redirect to
     */
    public function updateTags()
    {

        $this->syncTags();

        return redirect('/data');

    }

}
