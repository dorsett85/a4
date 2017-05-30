<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;

class Favorite extends Model
{

    // Connect to users
    public function user() {
        return $this->belongsTo('App\User');
    }


    // Connect to tags
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }


    // Get tags string for favorite companies in a key value pair array
    public static function getTagsForFavorites() {

        $favorites = Auth::user()->favorites()->orderBy('company_name')->get();

        $favoriteCompanyTags = [];
        $tagArray = [];

        foreach ($favorites as $company) {
            foreach($company->tags as $tags){
                $tagArray[] = $tags->name;
            }
            $eachCompanyTag = implode(', ', $tagArray);
            if (!empty($eachCompanyTag)) {
                $favoriteCompanyTags[$company->company_name] = $eachCompanyTag;

            } else {
                $favoriteCompanyTags[$company->company_name] = "Click on 'Get Data' to add tags";
            }
            $tagArray = [];
        }

        return $favoriteCompanyTags;

    }

}
