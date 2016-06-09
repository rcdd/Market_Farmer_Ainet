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


}