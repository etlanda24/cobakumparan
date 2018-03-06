<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public function topics()
    {
    	return $this->belongsToMany('App\Topic');
    }
}
