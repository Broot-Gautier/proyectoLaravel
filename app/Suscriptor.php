<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suscriptor extends Model
{
    public function users()
    {
    	return $this->belongsToMany('App\User','Suscriptor', 'user_id','suscriptor_id');
    }
}
