<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function usuario()
    {
    	return $this->belongsTo('App\User');
    }
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
}
