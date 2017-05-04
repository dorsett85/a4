<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }


    // Get tags string for favorite companies in a key value pair array
    public static function getTagsForFavorites() {

        $favorites = Favorite::orderBy('company_name')->get();

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
