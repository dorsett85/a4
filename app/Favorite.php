<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
