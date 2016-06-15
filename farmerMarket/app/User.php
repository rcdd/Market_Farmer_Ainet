<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'location', 'profile_photo', 'profile_url', 'mime_type', 'presentation', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function advertisements()
    {
        return $this->hasMany('App\Advertisement', 'owner_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    public function bids()
    {
        return $this->hasMany('App\Bids', 'buyer_id');
    }
}
