<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function favorites() {
        return $this->belongsToMany('App\Favorite')->withTimestamps();
    }
}
