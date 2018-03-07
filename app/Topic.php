<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
	protected $guarded = [];
	
    public function news()
    {
    	return $this->belongsToMany('App\News');
    }
}
