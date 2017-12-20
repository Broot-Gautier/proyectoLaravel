<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //** Esta es la relacion entre los modelos; o tablas  **//
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    //** relacion con suscriptores **//
    public function suscriptors()
    {
        return $this->belongsToMany('User','App\Suscriptor','user_id','suscriptor_id');
    }
    public function addSuscriptor(User $user)
    {
        $this->suscriptors()->attach($user->id);
    }
    public function removeSuscriptor(User $user)
    {
        $this->suscriptors()->detach($user->id);
    }
}
