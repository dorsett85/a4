<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }


    // Get tags for favorite companies in an array
    public static function getTagsForFavorites() {

        $favorites = Favorite::orderBy('company_name')->get();

        $favoriteCompanyTags = [];
        foreach ($favorites as $company) {
            foreach($company->tags as $tag){
                $favorites[$company->company_name] = $tag->name;
            }
        }

        return $favoriteCompanyTags;

    }

}
