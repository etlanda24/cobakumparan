<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function news()
    {
    	return $this->belongsToMany('App\News');
    }
}
