<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{	
	protected $guarded = [];
    
    public function topics()
    {
    	return $this->belongsToMany('App\Topic');
    }
}
