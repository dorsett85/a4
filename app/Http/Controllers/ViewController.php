<?php

namespace App\Http\Controllers;

use App\Company;
use App\Favorite;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Input;
use Session;
use Auth;

class ViewController extends StockController
{

    /*
     * Landing page
     */
    public function landing()
    {

        // Get example company info
        $landingInfo = $this->landingInfo();

        return view('pages.landing')->with([
            'landingInfo' => $landingInfo,
        ]);

    }


    /*
     * Login user homepage
     */
    public function guest()
    {

        $user = User::where('name', '=', 'Guest')->first();

        Auth::login($user);

        return redirect('/home');

    }


    /*
     * Login user homepage
     */
    public function welcome()
    {

        $userName = Auth::user()->name;

        $favoritesList = Auth::user()->favorites()->orderBy('company_name')->get();

        return view('pages.welcome')->with([
            'userName' => $userName,
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

        $favoritesList = Auth::user()->favorites()->orderBy('company_name')->get();

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

        $favoritesList = Auth::user()->favorites()->orderBy('company_name')->get();

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

        $favorites = Auth::user()->favorites()->orderBy('company_name')->get();

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

        $company = Auth::user()->favorites()->find($this->request->remove);
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
        $favoritesList = Auth::user()->favorites()->orderBy('company_name')->where('ticker', '!=', $ticker)->get();
        $favorite = Auth::user()->favorites()->with('tags')->where('ticker', '=', $ticker)->first();

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
