<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Advertisement extends Model
{
    public function file()
    {
        return $this->belongsTo('App\File');
    }

    public function user()
    {
    	return $this->belongsTo('App\User', 'owner_id');
    }

    public function medias()
    {
        return $this->hasMany('App\Media');
    }

	public function comments()
    {
        return $this->hasMany('App\Comments');
    }

    public function bids()
    {
        return $this->hasMany('App\Bids');
    }

    public function lastBid()
    {
       return $this->hasOne('App\Bids')->where('status', '=' , '1')->max('price_cents');
    }

    public function tag()
    {
        return $this->hasMany('App\Advertisement_tag');
    }

}